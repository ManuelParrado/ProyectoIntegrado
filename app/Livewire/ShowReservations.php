<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowReservations extends Component
{

    public $isReservationCancelVisible = false;
    public $filter;
    public $reservations;

    public function mount()
    {
        $this->filter = 'all';
        $this->searchReservations();
    }

    public function render()
    {
        return view('livewire.web_restaurant.show-reservations');
    }

    public function showDeleteModal($reservation)
    {
        $this->searchReservations();
        $this->dispatch('showDeleteModal', reservation: $reservation);
    }

    #[On('refresh')]
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
