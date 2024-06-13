<?php

namespace App\Livewire;

use App\Models\Dish;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowEditDishModal extends Component
{
    use WithFileUploads;

    public $isEditDishModalVisible = false;

    public $dish_id;
    public $name;
    public $type;
    public $price;
    public $new_image;
    public $old_image;
    public $image_key;
    public $visibility_status;

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.web_restaurant.admin.modals.show-edit-dish-modal');
    }

    public function editDish()
    {
        $this->price = str_replace(',', '.', $this->price);

        $this->validate([
            'price' => 'required|numeric|min:0|max:10000|regex:/^\d+(\.\d{1,2})?$/',
            'new_image' => 'nullable|image|max:1024',
            'visibility_status' => 'required|string|in:hidden,visible',
            'type' => 'required|string|in:appetizer,main_course,dessert,drink',
            'name' => 'required|string|min:2|max:50',
        ]);

        $dishDB = Dish::find($this->dish_id);
        $dishDB->name = $this->name;
        $dishDB->type = $this->type;
        $dishDB->price = $this->price;
        if ($this->new_image) {
            $dishDB->image = $this->new_image->store('images/dishes', 'public');
        }
        if ($this->visibility_status == 'visible') {
            $dishDB->visibility_status = null;
        } else {
            $dishDB->visibility_status = now();
        }
        $affected = $dishDB->save();

        if ($affected)
            $this->dispatch('openSuccessNotification', message: 'El plato ha sido modificado correctamente');
        else
            $this->dispatch('openErrorNotification', message: 'Ha ocurrido un error al modificar el plato');


        $this->dispatch('refresh');
        $this->hideEditDishModal();
    }

    public function showDishImage()
    {
        // Comprobamos si 'new_image' es una instancia de TemporaryUploadedFile
        if ($this->new_image) {
            $temporaryUrl = $this->new_image->temporaryUrl();
            $this->dispatch('showImageModal', image: $temporaryUrl, temporary: true);
        } else {
            // En caso de que no haya un archivo o no sea el tipo esperado
            $this->dispatch('showImageModal', image: $this->old_image, temporary: false);
        }
    }


    #[On('showEditDishModal')]
    public function showEditDishModal($dish)
    {
        $this->dish_id = $dish['id'];
        $this->name = $dish['name'];
        $this->type = $dish['type'];
        $this->price = $dish['price'];
        $this->old_image = $dish['image'];
        if ($dish['visibility_status'] == null) {
            $this->visibility_status = 'visible';
        } else {
            $this->visibility_status = 'hidden';
        }

        $this->isEditDishModalVisible = true;
    }

    public function hideEditDishModal()
    {
        $this->isEditDishModalVisible = false;
        $this->new_image = null;
        $this->image_key = rand();
    }
}
