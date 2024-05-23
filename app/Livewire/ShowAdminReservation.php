<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ShowAdminReservation extends Component
{
    public $isReservationAdministration = false;

    public function render()
    {
        return view('livewire.web_restaurant.admin.show-admin-reservation');
    }

    #[On('showReservationAdministration')]
    public function showUserAdministration()
    {
        $this->isReservationAdministration = true;
    }

    #[On('hideReservationAdministration')]
    public function hideUserAdministration()
    {
        $this->isReservationAdministration = false;
    }
}
