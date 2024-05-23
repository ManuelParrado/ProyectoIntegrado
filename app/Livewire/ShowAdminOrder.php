<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ShowAdminOrder extends Component
{
    public $isOrderAdministration = false;

    public function render()
    {
        return view('livewire.web_restaurant.admin.show-admin-order');
    }

    #[On('showOrderAdministration')]
    public function showOrderAdministration()
    {
        $this->isOrderAdministration = true;
    }

    #[On('hideOrderAdministration')]
    public function hideOrderAdministration()
    {
        $this->isOrderAdministration = false;
    }
}
