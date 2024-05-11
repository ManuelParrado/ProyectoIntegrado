<?php

namespace App\Livewire;

use App\Models\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class ShowReservationTableModals extends Component
{
    public $isSearchModalVisible = false;
    public $isReservationModalVisible = false;
    public $isConfirmationModalVisible = false;
    public $tables = [];
    public $id_tables_reserved = [];
    public $reservationTimeslot = '20:00 - 21:00';
    public $reservationDate = null;
    public $comprobationSearchErrorMessage = '';
    public $comprobationReserveErrorMessage = '';
    public $tableCapacity = '';
    public $tableNumber = '';

    public function render()
    {
        return view('livewire.web_restaurant.show-reservation-table-modals');
    }

    public function reserveComprobation()
    {
        if ($this->reservationDate != null) {
            $this->comprobationSearchErrorMessage = '';

            $this->id_tables_reserved = DB::table('user_table')
                ->select('id_table')
                ->where('date', '=', $this->reservationDate)
                ->where('timeslot', '=', $this->reservationTimeslot)
                ->get()
                ->pluck('id_table');

            $this->tables = Table::all();

            $this->showReservationModal();
        } else {
            $this->comprobationSearchErrorMessage = 'Introduzca los datos de búsqueda correctamente';
        }
    }

    public function showTableInformation($table_id)
    {
        $table = Table::find($table_id);

        $this->tableNumber = $table->number;
        $this->tableCapacity = $table->capacity;
    }

    public function doReservation()
    {
        DB::table('user_table')->insert([
            'id_table' => $this->tableNumber,
            'id_user' => Auth::user()->id,
            'date' => $this->reservationDate,
            'timeslot' => $this->reservationTimeslot,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        redirect('dashboard');
    }

    #[On('openModals')]
    public function showSearchModal()
    {
        $this->isSearchModalVisible = true;
    }

    public function hideSearchModal()
    {
        $this->isSearchModalVisible = false;
    }

    public function showReservationModal()
    {
        $this->hideSearchModal();
        $this->isReservationModalVisible = true;
    }

    public function hideReservationModal()
    {
        $this->showSearchModal();
        $this->isReservationModalVisible = false;
    }
    public function showConfirmationModal()
    {
        if (
            $this->tableCapacity != null &&
            $this->tableNumber != null &&
            $this->reservationDate != null &&
            $this->reservationTimeslot != null
        ) {
            $this->comprobationReserveErrorMessage = '';
            $this->isConfirmationModalVisible = true;
        } else
            $this->comprobationReserveErrorMessage = 'Seleccione una mesa';
    }

    public function hideConfirmationModal()
    {
        $this->isConfirmationModalVisible = false;
        $this->tableCapacity = '';
        $this->tableNumber = '';
    }

    public function closeAllModals()
    {
        $this->isSearchModalVisible = false;
        $this->isReservationModalVisible = false;
        $this->isConfirmationModalVisible = false;
        $this->tables = [];
        $this->id_tables_reserved = [];
        $this->reservationTimeslot = '20:00 - 21:00';
        $this->reservationDate = null;
        $this->comprobationSearchErrorMessage = '';
        $this->comprobationReserveErrorMessage = '';
        $this->tableCapacity = '';
        $this->tableNumber = '';
    }
}
