<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowAdminReservation extends Component
{
    public $isReservationAdministration = false;
    public $selected_date;

    public function mount()
    {
        $this->selected_date = now()->format('m-d-Y');
        $this->isReservationAdministration = true;
    }

    #[On('dateSelected')]
    public function updateDate($date)
    {
        $this->selected_date = $date;
    }

    public function render()
    {
        $reservations = $this->searchReservations();
        return view(
            'livewire.web_restaurant.admin.show-admin-reservation',
            ['reservations' => $reservations]
        );
    }

    public function searchReservations()
    {
        $selected_date = \Carbon\Carbon::createFromFormat('m-d-Y', $this->selected_date)->format('Y-m-d');

        return DB::table('table_user')
            ->where('date', $selected_date)
            ->get();
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
