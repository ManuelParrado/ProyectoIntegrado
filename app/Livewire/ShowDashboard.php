<?php

namespace App\Livewire;

use App\Models\Table;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowDashboard extends Component
{

    public $isSearchModalVisible = false;
    public $isReservationModalVisible = false;
    public $tables = [];
    public $id_tables_reserved = [];
    public $reservationTimeslot = '20:00 - 21:00';
    public $reservationDate = null;
    public $comprationReserverErrorMessage = '';
    public $tableCapacity = '';
    public $tableNumber = '';

    public function render()
    {
        return view('livewire.web_restaurant.show-dashboard');
    }

    public function reserveComprobation()
    {
        if ($this->reservationDate != null) {
            $this->comprationReserverErrorMessage = '';

            $this->id_tables_reserved = DB::table('user_table')
                ->select('id_table')
                ->where('date', '=', $this->reservationDate)
                ->where('timeslot', '=', $this->reservationTimeslot)
                ->get()
                ->pluck('id_table');

            $this->tables = Table::all();

            $this->showReservationModal();
        } else {
            $this->comprationReserverErrorMessage = 'Introduzca bien los datos de búsqueda';
        }
    }

    public function showTableInformation($table_id)
    {
        $table = Table::find($table_id);

        $this->tableNumber = $table->number;
        $this->tableCapacity = $table->capacity;
    }

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
        $this->isReservationModalVisible = false;
    }

    public function refresh()
    {
    }
}
