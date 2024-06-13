<?php

namespace App\Livewire;

use App\Models\Dish;
use Livewire\Component;

class ShowDish extends Component
{

    public $typeFilter;

    public function mount()
    {
        $this->typeFilter = 'appetizer';
    }

    public function render()
    {
        $dishes = $this->searchDishes();
        return view('livewire.web_restaurant.show-dish', ['dishes' => $dishes]);
    }

    public function searchDishes()
    {
        return Dish::where('type', $this->typeFilter)->get();
    }
}
