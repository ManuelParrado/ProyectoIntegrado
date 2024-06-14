<?php

namespace App\Livewire;

use App\Models\Dish;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowAdminDish extends Component
{
    use WithPagination, WithFileUploads;

    public $isDishAdministration = true;
    public $filter = 'all';
    public $statusFilter = 'all';
    public $search = '';

    public $dishSelected;

    public function mount()
    {
        $this->filter = 'all';
        $this->statusFilter = 'all';
    }

    public function render()
    {
        $dishes = $this->searchDishes();
        return view('livewire.web_restaurant.admin.show-admin-dish', ['dishes' => $dishes]);
    }

    public function searchDishes()
    {
        $query = Dish::query();

        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->filter !== 'all') {
            $query->where('type', $this->filter);
        }

        if ($this->statusFilter == 'visible') {
            $query->whereNull('visibility_status');
        } else if ($this->statusFilter == 'hidden') {
            $query->whereNotNull('visibility_status');
        }

        return $query->paginate(5);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function showConfirmationModal($dish_id)
    {
        $this->dishSelected = $dish_id;
        $this->dispatch('openOperationConfirmationModal', message: '¿Estas seguro de eliminar este plato?', type: 'dish');
    }

    #[On('confirmDishOperation')]
    public function deleteDish()
    {
        $dish = Dish::find($this->dishSelected);
        if ($dish) {
            $dish->delete();
            $this->dispatch('openSuccessNotification', message: 'El plato ha sido eliminado correctamente');
        } else {
            $this->dispatch('openErrorNotification', message: 'Ha ocurrido un error al eliminar el plato');
        }
        $this->resetPage();
    }

    public function showDishImage($dish_image)
    {
        $this->dispatch('showImageModal', image: $dish_image, temporary: false);
    }

    public function showEditDishModal(Dish $dish)
    {
        $this->dispatch('showEditDishModal', dish: $dish);
    }

    public function showCreateDishModal()
    {
        $this->dispatch('showCreateDishModal');
    }

    #[On('showDishAdministration')]
    public function showDishAdministration()
    {
        $this->isDishAdministration = true;
    }

    #[On('hideDishAdministration')]
    public function hideDishAdministration()
    {
        $this->isDishAdministration = false;
    }

    #[On('refresh')]
    public function refresh()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }
}
