<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Livewire\Component;

class ShowSettingSidebar extends Component
{

    public $isProfileViewVisible = false;
    public $isReservationViewVisible = true;

    public function render()
    {
        return view('livewire.web_restaurant.sidebars.show-setting-sidebar');
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
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
