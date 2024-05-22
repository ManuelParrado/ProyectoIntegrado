<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use App\Models\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        return view('livewire.layout.navigation');
    }

    public function showModals()
    {
        $this->dispatch('openModals');
    }

    public function showSidebar()
    {
        $this->dispatch('showSidebar');
    }

    public function showLoginModal()
    {
        $this->dispatch('openLoginModal');
    }

    public function showRegisterModal()
    {
        $this->dispatch('openRegisterModal');
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}
