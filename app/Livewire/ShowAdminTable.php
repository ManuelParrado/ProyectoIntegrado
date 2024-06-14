<?php

namespace App\Livewire;

use App\Models\Table;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAdminTable extends Component
{
    use WithPagination;

    public $isTableAdministration = false;
    public $search = '';
    public $tableSelected;

    public function mount()
    {
        $this->resetPage(); // Buena práctica para asegurar que empieces en la página 1 al cargar el componente
    }

    public function render()
    {
        $tables = $this->searchTables();
        return view('livewire.web_restaurant.admin.show-admin-table', ['tables' => $tables]);
    }

    public function searchTables()
    {
        // La búsqueda se restablece al cambiar el término de búsqueda
        return Table::where('number', 'like', '%' . $this->search . '%')
            ->paginate(5);
    }

    public function showConfirmationModal($table_id)
    {
        // Asegurarse de guardar el ID de la mesa seleccionada para futuras operaciones
        $this->tableSelected = $table_id;
        $this->dispatch('openOperationConfirmationModal', message: '¿Estás seguro de eliminar esta mesa?', type: 'table');
    }

    #[On('confirmTableOperation')]
    public function deleteTable()
    {
        // Encuentra la mesa por el ID seleccionado y elimínala
        $table = Table::find($this->tableSelected);

        if ($table && $table->delete()) {
            $this->dispatch('openSuccessNotification', message: 'La mesa ha sido eliminada correctamente');
        } else {
            $this->dispatch('openErrorNotification', message: 'Ha ocurrido un error al eliminar la mesa');
        }

        $this->refresh(); // Actualiza la lista después de eliminar
    }

    public function openCreateTableModal()
    {
        $this->dispatch('openCreateTableModal');
    }

    public function openEditTableModal($table)
    {
        $this->dispatch('showEditTableModal', table: $table);
    }

    #[On('showTableAdministration')]
    public function showTableAdministration()
    {
        $this->isTableAdministration = true;
    }

    #[On('hideTableAdministration')]
    public function hideTableAdministration()
    {
        $this->isTableAdministration = false;
    }

    #[On('refresh')]
    public function refresh()
    {
        $this->resetPage(); // Restablece la paginación al actualizar la lista
        $this->searchTables();
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Restablece la paginación cuando el término de búsqueda cambia
    }
}
