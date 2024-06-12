<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowImageModal extends Component
{
    use WithFileUploads;
    public $isImageModalVisible = false;
    public $image;
    public $temporary;

    public function render()
    {
        return view('livewire.web_restaurant.modals.show-image-modal');
    }

    #[On('showImageModal')]
    public function showImageModal($image, $temporary = false)
    {
        $this->image = $image;
        $this->temporary = $temporary;
        $this->isImageModalVisible = true;
    }

    public function hideImageModal()
    {
        $this->isImageModalVisible = false;
    }
}
