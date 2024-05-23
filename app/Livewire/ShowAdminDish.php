<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ShowAdminDish extends Component
{
    public $isDishAdministration = false;

    public function render()
    {
        return view('livewire.web_restaurant.admin.show-admin-dish');
    }

    #[On('showDishAdministration')]
    public function showDishAdministration()
    {
        $this->isDishAdministration = true;
    }

    #[On('hideDishAdministration')]
    public function hideDishAdministration()
    {
        $this->isDishAdministration = false;
    }
}
