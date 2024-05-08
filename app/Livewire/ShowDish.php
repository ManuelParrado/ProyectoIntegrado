<?php

namespace App\Livewire;

use App\Models\Dish;
use Livewire\Component;

class ShowDish extends Component
{
    public $dishes;

    public function render()
    {
        $this->dishes = Dish::all();

        return view('livewire.web_restaurant.show-dish');
    }
}
