<?php

namespace App\Livewire;

use App\Models\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowDashboard extends Component
{
    public function render()
    {
        return view('livewire.web_restaurant.show-dashboard');
    }

    public function showModals()
    {
        $this->dispatch('openModals');
    }
}
