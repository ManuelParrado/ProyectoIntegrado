<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowRegisterModal extends Component
{
    public $isRegisterModalVisible = false;
    public string $name = '';
    public string $last_name = '';
    public string $telephone_number = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function render()
    {
        return view('livewire.web_restaurant.modals.show-register-modal');
    }

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'telephone_number' => ['required', 'numeric', 'max_digits:9'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }

    #[On('openRegisterModal')]
    public function showRegisterModal()
    {

        $this->isRegisterModalVisible = true;
    }

    public function hideRegisterModal()
    {

        $this->isRegisterModalVisible = false;
    }
}