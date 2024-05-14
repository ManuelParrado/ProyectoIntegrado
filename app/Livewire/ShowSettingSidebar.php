<?php

namespace App\Livewire;

use Livewire\Component;

class ShowSettingSidebar extends Component
{

    public $isProfileViewVisible = true;
    public $isReservationViewVisible = false;

    public function render()
    {
        return view('livewire.web_restaurant.sidebars.show-setting-sidebar');
    }

    public function showReservationView()
    {
        $this->hideProfileView();
        $this->isReservationViewVisible = true;
    }

    public function hideReservationView()
    {
        $this->isReservationViewVisible = false;
    }

    public function showProfileView()
    {
        $this->hideReservationView();
        $this->isProfileViewVisible = true;
    }

    public function hideProfileView()
    {
        $this->isProfileViewVisible = false;
    }
}
