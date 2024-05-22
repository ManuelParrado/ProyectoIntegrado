<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ShowConfirmationOperationModal extends Component
{
    public $isConfirmationOperationModalVisible = false;
    public $message = '';

    public function render()
    {
        return view('livewire.web_restaurant.modals.show-confirmation-operation-modal');
    }

    #[On('openOperationConfirmationModal')]
    public function showConfirmationOperationModal($message)
    {
        $this->message = $message;
        $this->isConfirmationOperationModalVisible = true;
    }

    public function hideOperationModal()
    {
        $this->isConfirmationOperationModalVisible = false;
    }

    public function confirmOperation()
    {
        $this->dispatch('confirmOperation');
    }
}
