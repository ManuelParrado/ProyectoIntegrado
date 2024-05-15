<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowReservations extends Component
{
    use WithPagination;

    public $isReservationCancelVisible = false;
    public $filter;

    public function mount()
    {
        $this->filter = 'all';
    }

    public function render()
    {
        $reservations = $this->searchReservations();
        return view('livewire.web_restaurant.show-reservations', ['reservations' => $reservations]);
    }

    public function showConfirmationDeleteModal($reservation)
    {
        $this->searchReservations();
        $this->dispatch('showConfirmationDeleteModal', reservation: $reservation);
    }

    #[On('refresh')]
    public function searchReservations()
    {
        $user_id = Auth::user()->id;

        switch ($this->filter) {
            case 'all':
                return DB::table('table_user')
                    ->where('user_id', $user_id)
                    ->paginate(5);

            case 'active':
                return DB::table('table_user')
                    ->where('user_id', $user_id)
                    ->where('deleted_at', null)
                    ->paginate(5);

            case 'cancelled':
                return DB::table('table_user')
                    ->where('user_id', $user_id)
                    ->where('deleted_at', '!=', null)
                    ->paginate(5);

            default:
                # code...
                break;
        }
    }
}
