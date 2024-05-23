<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ShowAdminTable extends Component
{
    public $isTableAdministration = false;

    public function render()
    {
        return view('livewire.web_restaurant.admin.show-admin-table');
    }

    #[On('showTableAdministration')]
    public function showTableAdministration()
    {
        $this->isTableAdministration = true;
    }

    #[On('hideTableAdministration')]
    public function hideTableAdministration()
    {
        $this->isTableAdministration = false;
    }
}
