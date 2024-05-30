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


    public $isReservationAdministration = false;
    public $selected_date;
    public $filter;


    public $totalCapacityByTimeslot = 0;
    public $totalCapacity = 0;
    public $groupedReservations;


    public function mount()
    {
        $this->searchReservations();
        $this->filter = 'all';
        $this->totalCapacity = 0;
        $this->selected_date = now()->format('Y-m-d');
        $this->isReservationAdministration = true;
    }

    public function render()
    {
        return view('livewire.web_restaurant.admin.show-admin-reservation', [
            'groupedReservations' => $this->groupedReservations,
        ]);
    }

    public function updatedFilter()
    {
        $this->searchReservations(); // Actualiza reservas cuando el filtro cambia.
    }

    public function updatedSelectedDate()
    {
        $this->searchReservations(); // Actualiza reservas cuando la fecha seleccionada cambia.
    }

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

        // Calcular la capacidad total
        $this->totalCapacity = $reservations->sum('table_capacity');
    }



    public function setFilter($filter)
    {
        $this->filter = $filter;
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
