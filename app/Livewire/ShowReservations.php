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
    public $selected_date;
    public $filter;
    public $statusFilter;

    public function mount()
    {
        $this->filter = 'all';
        $this->statusFilter = 'all';
        $this->selected_date = now()->format('Y-m-d');
        //$this->selected_date = '2024-06-05';
    }

    public function render()
    {
        $reservations = $this->searchReservations();
        return view('livewire.web_restaurant.show-reservations', ['reservations' => $reservations]);
    }

    public function showSearchReservationModal($reservationId)
    {
        $this->dispatch('openReservationModals', reservationId: $reservationId);
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

        $query = DB::table('table_user')
            ->join('users', 'table_user.user_id', '=', 'users.id')
            ->join('tables', 'table_user.table_id', '=', 'tables.id')
            ->select(
                'table_user.*',
                'users.name as user_name',
                'users.last_name as user_last_name',
                'users.email as user_email',
                'users.telephone_number as user_telephone',
                'tables.number as table_number',
                'tables.capacity as table_capacity',
                'table_user.timeslot'
            )
            ->where('table_user.date', $this->selected_date)
            ->where('table_user.user_id', $user_id);

        if ($this->statusFilter === 'active') {
            $query->whereNull('table_user.deleted_at');
        } elseif ($this->statusFilter === 'cancelled') {
            $query->whereNotNull('table_user.deleted_at');
        }

        // Aplica el filtro de timeslot según la selección del usuario
        if ($this->filter === 'day') {
            $query->whereIn('table_user.timeslot', [
                '12:00 - 13:00', '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00'
            ]);
        } elseif ($this->filter === 'night') {
            $query->whereIn('table_user.timeslot', [
                '20:00 - 21:00', '21:00 - 22:00', '22:00 - 23:00', '23:00 - 00:00'
            ]);
        }

        return $query->paginate(4);
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();  // Resetear la paginación al cambiar el filtro
        $this->searchReservations();
    }

    public function setStatusFilter($statusFilter)
    {
        $this->statusFilter = $statusFilter;
        $this->resetPage();  // Resetear la paginación al cambiar el filtro
        $this->searchReservations();
    }
}
