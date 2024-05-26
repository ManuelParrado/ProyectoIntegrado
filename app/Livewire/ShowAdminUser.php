<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAdminUser extends Component
{
    use WithPagination;

    public $isUserAdministration;
    public $search = '';
    public $filter;
    public $confirmationMessage = '';
    public $confirmationColor = '';
    public $userSelected;

    public function mount()
    {
        $this->filter = 'all';
        $this->isUserAdministration = true;
    }

    public function render()
    {
        $users = $this->searchUsers();
        return view('livewire.web_restaurant.admin.show-admin-user', ['users' => $users]);
    }

    public function showConfirmationModal($user_id)
    {
        $this->dispatch('openOperationConfirmationModal', message: '¿Estas seguro de eliminar este usuario?');
        $this->userSelected = $user_id;
    }

    #[On('confirmOperation')]
    public function deleteUser()
    {
        $user = User::find($this->userSelected);

        if ($user) {
            $user->delete();
            $this->confirmationMessage = 'Usuario eliminado correctamente';
            $this->confirmationColor = 'green';
        } else {
            $this->confirmationMessage = 'Usuario no encontrado';
            $this->confirmationColor = 'red';
        }
    }

    public function openEditUserModal($user)
    {
        $this->dispatch('showEditUserModal', user: $user);
    }

    public function searchUsers()
    {
        $query = User::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('email', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('telephone_number', 'like', '%' . $this->search . '%')
                    ->orWhere('role', 'like', '%' . $this->search . '%');
            });
        }

        switch ($this->filter) {
            case 'not_deleted':
                $query->whereNull('deleted_at');
                break;
            case 'deleted':
                $query->whereNotNull('deleted_at');
                break;
            case 'admin':
                $query->where('role', 'admin');
                break;
            case 'user':
                $query->where('role', 'user');
                break;
            case 'all':
            default:
                // No additional conditions
                break;
        }

        $query->where('id', '!=', auth()->id());

        return $query->paginate(3);
    }

    public function clearSearch()
    {
        $this->search = '';
    }

    #[On('setEditConfirmationMessage')]
    public function setEditConfirmationMessage($affected)
    {
        if ($affected) {
            $this->confirmationMessage = 'Usuario editado correctamente';
            $this->confirmationColor = 'green';
        } else {
            $this->confirmationMessage = 'No se pudo editar el usuario';
            $this->confirmationColor = 'red';
        }
    }

    #[On('showUserAdministration')]
    public function showUserAdministration()
    {
        $this->isUserAdministration = true;
    }

    #[On('hideUserAdministration')]
    public function hideUserAdministration()
    {
        $this->isUserAdministration = false;
    }
}
