<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShowEditUserModal extends Component
{
    public $isEditUserModalVisible = false;
    public $user_id;

    #[Validate('required|email|max:255')]
    public $email;

    #[Validate('required|string|min:2|max:50')]
    public $name;

    #[Validate('required|string|min:2|max:50')]
    public $last_name;

    #[Validate('required|digits:9')]
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
        $this->validate();

        $userDB = User::find($this->user_id);
        $userDB->email = $this->email;
        $userDB->name = $this->name;
        $userDB->last_name = $this->last_name;
        $userDB->telephone_number = $this->telephone_number;
        $userDB->role = $this->role;
        $affected = $userDB->save();

        $this->dispatch('setEditConfirmationMessage', affected: $affected);
        $this->hideEditUserModal();
    }

    public function hideEditUserModal()
    {
        $this->isEditUserModalVisible = false;
    }
}
