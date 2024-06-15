<?php

namespace App\Livewire;

use App\Models\User;
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
    public $userSelected;

    public function mount()
    {
        $this->filter = 'all';
    }

    public function render()
    {
        $users = $this->searchUsers();
        return view('livewire.web_restaurant.admin.show-admin-user', ['users' => $users]);
    }

    public function showConfirmationModal($user_id)
    {
        $this->dispatch('openOperationConfirmationModal', message: '¿Estas seguro de eliminar este usuario?', type: 'user');
        $this->userSelected = $user_id;
    }

    #[On('confirmUserOperation')]
    public function deleteUser()
    {
        DB::beginTransaction();

        try {
            // Verifica primero si el usuario existe
            $userExists = DB::table('users')->where('id', $this->userSelected)->exists();
            if (!$userExists) {
                $this->dispatch('openErrorNotification', message: 'Usuario no encontrado');
                return;
            }

            // Desvincula las claves foráneas en table_user
            DB::table('table_user')->where('user_id', $this->userSelected)->delete();

            // Elimina el usuario
            $affected = DB::table('users')->where('id', $this->userSelected)->delete();

            DB::commit();

            if ($affected) {
                $this->dispatch('openSuccessNotification', message: 'El usuario ha sido eliminado correctamente');
            } else {
                $this->dispatch('openErrorNotification', message: 'Ha ocurrido un error al eliminar el usuario');
            }

            $this->resetPage();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('openErrorNotification', message: 'Error al eliminar el usuario: ' . $e->getMessage());
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
                    ->orWhere('role', 'like', '%' . $this->search . '%')
                    ->orWhere('created_at', 'like', '%' . $this->search . '%')
                    ->orWhere('updated_at', 'like', '%' . $this->search . '%');
            });
        }

        switch ($this->filter) {
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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    #[On('setEditConfirmationMessage')]
    public function setEditConfirmationMessage($affected)
    {
        if ($affected) {
            $this->dispatch('openSuccessNotification', message: 'El usuario ha sido modificado correctamente');
        } else {
            $this->dispatch('openErrorNotification', message: 'Ha ocurrido un error al modificar el usuario');
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
