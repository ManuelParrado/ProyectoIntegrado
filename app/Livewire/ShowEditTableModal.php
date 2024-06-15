<?php

namespace App\Livewire;

use App\Models\Table;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShowEditTableModal extends Component
{
    public $isEditTableModalVisible = false;
    public $table_id;

    #[Validate('required|numeric')]
    public $number;
    #[Validate('required|numeric|max:20')]
    public $capacity;

    public function render()
    {
        return view('livewire.web_restaurant.admin.modals.show-edit-table-modal');
    }

    public function editTable()
    {
        $this->validate();

        $tableDB = Table::find($this->table_id);
        $tableDB->number = $this->number;
        $tableDB->capacity = $this->capacity;
        $affected = $tableDB->save();

        if ($affected)
            $this->dispatch('openSuccessNotification', message: 'La mesa ha sido modificada correctamente');
        else
            $this->dispatch('openErrorNotification', message: 'Ha ocurrido un error al modificar la mesa');

        $this->dispatch('refresh');

        $this->hideEditTableModal();
    }

    #[On('showEditTableModal')]
    public function showEditUserModal($table)
    {
        $this->table_id = $table['id'];
        $this->number = $table['number'];
        $this->capacity = $table['capacity'];
        $this->isEditTableModalVisible = true;
    }

    public function hideEditTableModal()
    {
        $this->isEditTableModalVisible = false;
    }
}
