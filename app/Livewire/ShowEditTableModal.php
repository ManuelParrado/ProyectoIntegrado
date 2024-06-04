<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShowEditTableModal extends Component
{
    public $isEditTableModalVisible = false;
    #[Validate('required|unique:tables|number')]
    public $number;
    #[Validate('required|number|max:20')]
    public $capacity;

    public function render()
    {
        return view('livewire.web_restaurant.admin.modals.show-edit-table-modal');
    }

    #[On('showEditTableModal')]
    public function showEditUserModal($table)
    {
        $this->number = $table['table']['number'];
        $this->capacity = $table['table']['capacity'];
        $this->isEditTableModalVisible = true;
    }

    public function hideEditTableModal()
    {
        $this->isEditTableModalVisible = false;
    }
}
