<?php

namespace App\Livewire;

use Livewire\Component;

class ShowFooter extends Component
{
    public function render()
    {
        return view('livewire.web_restaurant.footer.show-footer');
    }

    public function showReservationModal()
    {
        if (auth()->check()) {
            $this->dispatch('openReservationModals');
        } else {
            $this->dispatch('openLoginModal');
        }
    }
}
