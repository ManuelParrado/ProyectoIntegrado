<?php

namespace App\Livewire;

use Livewire\Component;

class ShowAdminSidebar extends Component
{
    public function render()
    {
        return view('livewire.web_restaurant.admin.sidebar.show-admin-sidebar');
    }

    public function showUserAdministration()
    {

        $this->resetAdministrationSections();
        $this->dispatch('showUserAdministration');
    }

    public function showReservationAdministration()
    {

        $this->resetAdministrationSections();
        $this->dispatch('showReservationAdministration');
    }

    public function showTableAdministration()
    {

        $this->resetAdministrationSections();
        $this->dispatch('showTableAdministration');
    }

    public function showDishAdministration()
    {
        $this->resetAdministrationSections();
        $this->dispatch('showDishAdministration');
    }

    public function showOrderAdministration()
    {
        $this->resetAdministrationSections();
        $this->dispatch('showOrderAdministration');
    }

    private function resetAdministrationSections()
    {
        $this->dispatch('hideUserAdministration');
        $this->dispatch('hideReservationAdministration');
        $this->dispatch('hideTableAdministration');
        $this->dispatch('hideDishAdministration');
        $this->dispatch('hideOrderAdministration');
    }
}
