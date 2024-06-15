<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShowEditUserModal extends Component
{
    public $isEditUserModalVisible = false;
    public $user_id;

    public $email;
    public $name;

    public $last_name;

    public $telephone_number;

    #[Validate('required|string|in:admin,user')]
    public $role;

    public function render()
    {
        return view('livewire.web_restaurant.admin.modals.show-edit-user-modal');
    }

    #[On('showEditUserModal')]
    public function showEditUserModal($user)
    {
        $this->user_id = $user['id'];
        $this->email = $user['email'];
        $this->name = $user['name'];
        $this->last_name = $user['last_name'];
        $this->telephone_number = $user['telephone_number'];
        $this->role = $user['role'];
        $this->isEditUserModalVisible = true;
    }

    public function editUser()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user_id)],
            'role' => ['required', 'string', 'in:user,admin'],
            'last_name' => ['required', 'string', 'max:255'],
            'telephone_number' => ['required', 'numeric', 'digits:9'],
        ]);

        $userDB = User::find($this->user_id);
        $userDB->email = $validated['email'];
        $userDB->name = $validated['name'];
        $userDB->last_name = $validated['last_name'];
        $userDB->telephone_number = $validated['telephone_number'];
        $userDB->role = $validated['role'];
        $affected = $userDB->save();

        $this->dispatch('setEditConfirmationMessage', affected: $affected);
        $this->hideEditUserModal();
    }

    public function hideEditUserModal()
    {
        $this->isEditUserModalVisible = false;
    }
}
