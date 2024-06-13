<?php

namespace App\Livewire;

use App\Models\Dish;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowCreateDishModal extends Component
{
    use WithFileUploads;

    public $isCreateDishModalVisible = false;

    public $name;
    public $type = 'main_course';
    public $price;
    public $image;
    public $visibility_status = 'visible';
    public $image_key;

    public function render()
    {
        return view('livewire.web_restaurant.admin.modals.show-create-dish-modal');
    }

    public function createDish()
    {
        $this->price = str_replace(',', '.', $this->price);

        $this->validate([
            'price' => 'required|numeric|min:0|max:10000|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'required|image|max:1024',
            'visibility_status' => 'required|string|in:hidden,visible',
            'type' => 'required|string|in:appetizer,main_course,dessert,drink',
            'name' => 'required|string|min:2|max:50',
        ]);

        $dish = new Dish();
        $dish->name = $this->name;
        $dish->type = $this->type;
        $dish->price = $this->price;

        if ($this->image) {
            $dish->image = $this->image->store('images/dishes', 'public');
        }
        if ($this->visibility_status == 'visible') {
            $dish->visibility_status = null;
        } else {
            $dish->visibility_status = now();
        }

        $affected = $dish->save();

        if ($affected)
            $this->dispatch('openSuccessNotification', message: 'El plato ha sido creado correctamente');
        else
            $this->dispatch('openErrorNotification', message: 'Ha ocurrido un error al crear el plato');

        $this->image_key = rand();
        $this->dispatch('refresh');
        $this->hideCreateDishModal();
    }

    public function showDishImage()
    {
        // Comprobamos si 'new_image' es una instancia de TemporaryUploadedFile
        if ($this->image) {
            $temporaryUrl = $this->image->temporaryUrl();
            $this->dispatch('showImageModal', image: $temporaryUrl, temporary: true);
        } else {
            // En caso de que no haya un archivo o no sea el tipo esperado
            $this->dispatch('showImageModal', image: null, temporary: true);
        }
    }

    #[On('showCreateDishModal')]
    public function showCreateDishModal()
    {
        $this->isCreateDishModalVisible = true;
    }

    public function hideCreateDishModal()
    {
        $this->isCreateDishModalVisible = false;
        $this->image = null;
        $this->image_key = rand();
        $this->name = '';
        $this->price = '';
    }
}
