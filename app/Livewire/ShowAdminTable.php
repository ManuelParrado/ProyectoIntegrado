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
    public $search;
    public $tableSelected;

    public function mount()
    {
        $this->searchTables();
    }

    public function render()
    {
        $tables = $this->searchTables();
        return view('livewire.web_restaurant.admin.show-admin-table', ['tables' => $tables]);
    }

    public function searchTables()
    {
        return Table::where('number', 'like', '%' . $this->search . '%')
            ->orWhere('capacity', 'like', '%' . $this->search . '%')
            ->orWhere('created_at', 'like', '%' . $this->search . '%')
            ->orWhere('updated_at', 'like', '%' . $this->search . '%')
            ->paginate(5);
    }

    public function showConfirmationModal($table_id)
    {
        $this->dispatch('openOperationConfirmationModal', message: '¿Estas seguro de eliminar esta mesa?', type: 'table');
        $this->tableSelected = $table_id;
    }

    #[On('confirmTableOperation')]
    public function deleteUser()
    {
        $table = Table::find($this->tableSelected);

        $table->delete();

        if ($table)
            $this->dispatch('openSuccessNotification', message: 'La mesa ha sido eliminada correctamente');
        else
            $this->dispatch('openErrorNotification', message: 'Ha ocurrido un error al eliminar la mesa');

        $this->dispatch('refresh');
    }

    public function openCreateTableModal()
    {
        $this->dispatch('openCreateTableModal');
    }

    public function openEditTableModal($table)
    {
        $this->dispatch('showEditTableModal', ['table' => $table]);
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
        $this->searchTables();
    }
}
