<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAdminReservation extends Component
{

    use WithPagination;

    public $isReservationAdministration = false;
    public $selected_date;
    public $totalCapacityByTimeslot = 0;

    public function mount()
    {
        //$this->selected_date = now()->format('m-d-Y');
        $this->selected_date = '05-27-2024';
        $this->isReservationAdministration = true;
    }

    #[On('dateSelected')]
    public function updateDate($date)
    {
        $this->selected_date = $date;
    }

    public function render()
    {
        $groupedReservations = $this->searchReservations();
        return view(
            'livewire.web_restaurant.admin.show-admin-reservation',
            ['groupedReservations' => $groupedReservations]
        );
    }

    public function searchReservations()
    {
        $selected_date = \Carbon\Carbon::createFromFormat('m-d-Y', $this->selected_date)->format('Y-m-d');

        return DB::table('table_user')
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
            )
            ->where('table_user.date', $selected_date)
            ->orderBy('table_user.timeslot')
            ->get()
            ->groupBy('timeslot');
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
