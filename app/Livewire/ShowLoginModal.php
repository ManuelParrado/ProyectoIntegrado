<?php

namespace App\Livewire;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowLoginModal extends Component
{
    public LoginForm $form;
    public $isLoginModalVisible = false;

    public function render()
    {
        return view('livewire.web_restaurant.modals.show-login-modal');
    }

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }


    #[On('openLoginModal')]
    public function showLoginModal()
    {
        $this->isLoginModalVisible = true;
    }

    public function hideLoginModal()
    {
        $this->isLoginModalVisible = false;
    }
}
