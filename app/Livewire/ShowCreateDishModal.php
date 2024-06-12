<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowCreateDishModal extends Component
{
    use WithFileUploads;

    public $isCreateDishModalVisible = false;

    public $name;
    public $type;
    public $price;
    public $new_image;
    public $image_key;

    public function render()
    {
        return view('livewire.web_restaurant.admin.modals.show-create-dish-modal');
    }

    public function showDishImage()
    {
        // Comprobamos si 'new_image' es una instancia de TemporaryUploadedFile
        if ($this->new_image) {
            $temporaryUrl = $this->new_image->temporaryUrl();
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
    }
}
