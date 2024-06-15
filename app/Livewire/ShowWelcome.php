<?php

namespace App\Livewire;

use Livewire\Component;

class ShowWelcome extends Component
{

    public $showModal = false;

    public function mount()
    {
        if (session()->has('showModal')) {
            $this->dispatch('openLoginModal');
        }
    }

    public function render()
    {

        return view('livewire.web_restaurant.show-welcome');
    }

    public function showReservationTableModal()
    {
        if (auth()->check()) {
            $this->dispatch('openReservationModals');
        } else {
            $this->dispatch('openLoginModal');
        }
    }
}
