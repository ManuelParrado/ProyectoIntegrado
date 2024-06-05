<?php

namespace App\Livewire;

use App\Models\Table;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShowCreateTableModal extends Component
{

    public $isCreateTableModalVisible = false;
    public $table_id;

    #[Validate('required|numeric|unique:tables,number')]
    public $number;
    #[Validate('required|numeric|max:20')]
    public $capacity;

    public function render()
    {
        return view('livewire.web_restaurant.admin.modals.show-create-table-modal');
    }

    public function createTable()
    {
        $this->validate();

        $table = new Table();
        $table->number = $this->number;
        $table->capacity = $this->capacity;
        $table->save();

        if ($table)
            $this->dispatch('openSuccessNotification', message: 'La mesa ha sido creada correctamente');
        else
            $this->dispatch('openErrorNotification', message: 'Ha ocurrido un error al creada la mesa');

        $this->dispatch('refresh');

        $this->hideCreateTableModal();
    }

    #[On('openCreateTableModal')]
    public function showCreateTableModal()
    {
        $this->isCreateTableModalVisible = true;
    }

    public function hideCreateTableModal()
    {
        $this->isCreateTableModalVisible = false;
    }
}
