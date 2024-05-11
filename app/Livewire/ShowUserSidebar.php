<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowUserSidebar extends Component
{
    public $isSidebarVisible = false;
    public function render()
    {
        return view('livewire.web_restaurant.show-user-sidebar');
    }

    #[On('showSidebar')]
    public function showSideBar()
    {
        $this->isSidebarVisible = true;
    }

    public function hideSideBar()
    {
        $this->isSidebarVisible = false;
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}
