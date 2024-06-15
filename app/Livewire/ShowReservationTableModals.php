<?php

namespace App\Livewire;

use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
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
        if ($this->reservationDate != null && $this->reservationTimeslot != null) {
            $this->comprobationSearchErrorMessage = '';

            // Convertir la fecha de reserva a instancia de Carbon
            $reservationDate = Carbon::parse($this->reservationDate);

            // Obtener la fecha y hora actual
            $now = Carbon::now();

            // Comprobar que la fecha de reserva no sea anterior a la fecha actual
            if ($reservationDate->lt($now->startOfDay())) {
                $this->comprobationSearchErrorMessage = 'La fecha de reserva no puede ser anterior a hoy.';
                return;
            }

            // Comprobación de disponibilidad de mesas
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
            $this->comprobationSearchErrorMessage = 'Por favor, introduzca los datos de la reserva.';
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
            $this->modalTitle = 'Cambiar reserva';
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
