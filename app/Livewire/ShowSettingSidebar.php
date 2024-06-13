<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowSettingSidebar extends Component
{

    public $isProfileViewVisible = false;
    public $isReservationViewVisible = true;
    public $isOrderViewVisible = false;

    public function render()
    {
        return view('livewire.web_restaurant.sidebars.show-setting-sidebar');
    }

    #[On('confirmOperation')]
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function showConfirmationLogoutModal()
    {
        $this->dispatch('openOperationConfirmationModal', message: '¿Estas seguro de cerrar sesión?');
    }

    public function showReservationView()
    {
        $this->resetViews();
        $this->isReservationViewVisible = true;
    }

    public function showProfileView()
    {
        $this->resetViews();
        $this->isProfileViewVisible = true;
    }

    public function showOrderView()
    {
        $this->resetViews();
        $this->isOrderViewVisible = true;
    }

    public function resetViews()
    {
        $this->isProfileViewVisible = false;
        $this->isReservationViewVisible = false;
        $this->isOrderViewVisible = false;
    }
}
