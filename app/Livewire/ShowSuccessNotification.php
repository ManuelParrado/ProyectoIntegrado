<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ShowSuccessNotification extends Component
{
    public $isNotificationVisible = false;
    public $message = '';

    public function render()
    {
        return view('livewire.web_restaurant.notifications.show-success-notification');
    }

    #[On('openSuccessNotification')]
    public function showNotification($message)
    {
        $this->message = $message;
        $this->isNotificationVisible = true;
    }

    public function hideNotification()
    {
        $this->message = '';
        $this->isNotificationVisible = false;
    }
}
