<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class ShowAdminReservation extends Component
{
    use WithPagination;


    public $isReservationAdministration = true;
    public $selected_date;
    public $filter;
    public $statusFilter;


    public $totalCapacityByTimeslot = 0;
    public $totalCapacity = 0;
    public $groupedReservations;


    public function mount()
    {
        $this->filter = 'all';
        $this->statusFilter = 'all';
        $this->totalCapacity = 0;
        //$this->selected_date = '2024-05-27';
        $this->selected_date = now()->format('Y-m-d');
        $this->searchReservations();
    }

    public function render()
    {
        return view('livewire.web_restaurant.admin.show-admin-reservation', [
            'groupedReservations' => $this->groupedReservations,
        ]);
    }

    public function updatedSelectedDate()
    {
        $this->searchReservations(); // Actualiza reservas cuando la fecha seleccionada cambia.
    }

    #[On('refresh')]
    public function searchReservations()
    {
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
            ->where('table_user.date', $this->selected_date);

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

        $reservations = $query->orderBy('table_user.timeslot')->get();

        // Agrupar los resultados por 'timeslot'
        $this->groupedReservations = $reservations->groupBy('timeslot');

        $this->totalCapacity = 0;

        // Calcular la capacidad total
        foreach ($reservations as $reservation) {
            if ($reservation->deleted_at == null)
                $this->totalCapacity += $reservation->table_capacity;
        }
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->searchReservations();
    }

    public function setStatusFilter($statusFilter)
    {
        $this->statusFilter = $statusFilter;
        $this->searchReservations();
    }

    public function showSearchReservationModal($reservationId)
    {
        $this->dispatch('openReservationModals', reservationId: $reservationId);
    }

    #[On('showReservationAdministration')]
    public function showUserAdministration()
    {
        $this->isReservationAdministration = true;
    }

    #[On('hideReservationAdministration')]
    public function hideUserAdministration()
    {
        $this->isReservationAdministration = false;
    }
}
