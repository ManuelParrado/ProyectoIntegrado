<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ShowConfirmationOperationModal extends Component
{
    public $isConfirmationOperationModalVisible = false;
    public $message = '';
    public $type;

    public function render()
    {
        return view('livewire.web_restaurant.modals.show-confirmation-operation-modal');
    }

    #[On('openOperationConfirmationModal')]
    public function showConfirmationOperationModal($message, $type = '')
    {
        $this->message = $message;
        $this->type = $type;
        $this->isConfirmationOperationModalVisible = true;
    }

    public function hideOperationModal()
    {
        $this->isConfirmationOperationModalVisible = false;
    }

    public function confirmOperation()
    {
        if ($this->type == 'user') {
            $this->dispatch('confirmUserOperation');
        } else if ($this->type == 'table') {
            $this->dispatch('confirmTableOperation');
        } else if ($this->type == 'dish') {
            $this->dispatch('confirmDishOperation');
        } else {
            $this->dispatch('confirmOperation');
        }

        $this->hideOperationModal();
    }
}
