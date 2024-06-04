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

    public $isCreateMode = true;
    public $modalTitle;

    public $tables = [];
    public $id_tables_reserved = [];
    public $reservationId;
    public $reservationTimeslot = '20:00 - 21:00';
    public $reservationDate = null;
    public $comprobationSearchErrorMessage = '';
    public $comprobationReserveErrorMessage = '';
    public $tableCapacity = '';
    public $tableNumber = '';

    public function render()
    {
        return view('livewire.web_restaurant.modals.show-reservation-table-modals');
    }

    public function reserveComprobation()
    {
        if ($this->reservationDate != null) {
            $this->comprobationSearchErrorMessage = '';

            $this->id_tables_reserved = DB::table('table_user')
                ->select('table_id')
                ->where('date', '=', $this->reservationDate)
                ->where('timeslot', '=', $this->reservationTimeslot)
                ->whereNull('deleted_at')
                ->get()
                ->pluck('table_id');

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
        $message = '';

        if ($this->isCreateMode) {
            // Crear nueva reserva
            $rows = DB::table('table_user')->insert([
                'table_id' => $this->tableNumber,
                'user_id' => Auth::user()->id,
                'date' => $this->reservationDate,
                'timeslot' => $this->reservationTimeslot,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $message = 'Reserva realizada correctamente';
        } else {
            // Actualizar reserva existente
            $rows = DB::table('table_user')->where('id', $this->reservationId)->update([
                'date' => $this->reservationDate,
                'timeslot' => $this->reservationTimeslot,
                'table_id' => $this->tableNumber,
                'updated_at' => now()
            ]);
            $message = 'Reserva actualizada correctamente';
        }

        if ($rows) {
            $this->dispatch('openSuccessNotification', message: $message);
        } else {
            $this->dispatch('openErrorNotification', message: 'Ha ocurrido un error');
        }

        $this->dispatch('refresh');
        $this->closeAllModals();
    }

    #[On('openReservationModals')]
    public function showSearchModal($reservationId = null)
    {
        if ($reservationId) {
            $reservation = DB::table('table_user')->where('id', '=', $reservationId)->first();
            $this->reservationId = $reservationId;
            $this->reservationDate = $reservation->date;
            $this->reservationTimeslot = $reservation->timeslot;
            $this->tableNumber = $reservation->table_id;
            $this->isCreateMode = false;
            $this->modalTitle = 'Editar reserva';
        } else {
            $this->isCreateMode = true;
            $this->modalTitle = 'Hacer reserva';
        }
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
        $this->reservationId = '';
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
