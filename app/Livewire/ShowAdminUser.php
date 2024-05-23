<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ShowAdminUser extends Component
{
    public $isUserAdministration = false;

    public function render()
    {
        return view('livewire.web_restaurant.admin.show-admin-user');
    }

    #[On('showUserAdministration')]
    public function showUserAdministration()
    {
        $this->isUserAdministration = true;
    }

    #[On('hideUserAdministration')]
    public function hideUserAdministration()
    {
        $this->isUserAdministration = false;
    }
}
