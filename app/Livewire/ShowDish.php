<?php

namespace App\Livewire;

use App\Models\Table;
use Livewire\Component;

class ShowDish extends Component
{
    public $tables;

    public function mount()
    {
        $this->tables = Table::all();
    }

    public function render()
    {
        return view('livewire.web_restaurant.show-dish');
    }
}
