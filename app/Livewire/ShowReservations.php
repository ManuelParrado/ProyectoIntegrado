<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ShowReservations extends Component
{

    public $filter;
    public $reservations;

    public function mount()
    {
        $this->filter = 'all';
        $this->reservations = User::find(auth()->user()->id)->tables()->get();
    }

    public function render()
    {
        return view('livewire.web_restaurant.show-reservations');
    }

    public function setFilterAll()
    {
        $this->filter = 'all';
        $this->searchReservations();
    }

    public function setFilterActive()
    {
        $this->filter = 'active';
        $this->searchReservations();
    }

    public function setFilterCancelled()
    {

        $this->filter = 'cancelled';
        $this->searchReservations();
    }

    public function searchReservations()
    {
        switch ($this->filter) {
            case 'all':
                $this->reservations = User::find(auth()->user()->id)
                    ->tables()->get();
                break;

            case 'active':
                $this->reservations = User::find(auth()->user()->id)
                    ->tables()
                    ->whereNull('table_user.deleted_at')
                    ->get();
                break;

            case 'cancelled':
                $this->reservations = User::find(auth()->user()->id)
                    ->tables()
                    ->whereNotNull('table_user.deleted_at')
                    ->get();
                break;

            default:
                # code...
                break;
        }
    }
}
