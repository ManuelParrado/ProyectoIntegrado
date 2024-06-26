<?php

namespace App\Livewire;

use App\Models\Table;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowCancelReservationModal extends Component
{
    public $isConfirmationModalVisible = false;
    public $reservationDate;
    public $reservationTimeslot;
    public $reservation;

    public function render()
    {
        return view('livewire.web_restaurant.modals.show-cancel-reservation-modal');
    }

    #[On('showConfirmationDeleteModal')]
    public function showConfirmationDeleteModal($reservation)
    {

        $this->reservation = $reservation;
        $this->reservationDate = $this->reservation['date'];
        $this->reservationTimeslot = $this->reservation['timeslot'];
        $this->isConfirmationModalVisible = true;
    }

    public function hideConfirmationModal()
    {
        $this->isConfirmationModalVisible = false;
    }

    public function doCancelReservation()
    {
        $affeted = DB::table('table_user')
            ->where('id', $this->reservation['id'])
            ->update(['deleted_at' => now()]);

        if ($affeted) {
            $this->dispatch('openSuccessNotification', message: 'La reserva ha sido cancelada correctamente');
        } else {
            $this->dispatch('openErrorNotification', message: 'Ha ocurrido un error al cancelar la reserva');
        }

        $this->dispatch('refresh');

        $this->hideConfirmationModal();
    }
}
