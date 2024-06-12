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
    public $filter;

    public function mount()
    {
        $this->filter = 'all';
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
        $user_id = Auth::id();  // Obtener el ID del usuario autenticado

        $query = DB::table('table_user')
            ->join('tables', 'table_user.table_id', '=', 'tables.id')
            ->select('tables.number', 'tables.capacity', 'table_user.*')
            ->where('table_user.user_id', '=', $user_id);

        switch ($this->filter) {
            case 'active':
                $query->whereNull('table_user.deleted_at');  // Filtra por mesas activas
                break;
            case 'cancelled':
                $query->whereNotNull('table_user.deleted_at');  // Filtra por mesas canceladas
                break;
        }

        return $query->paginate(4);  // Pagina los resultados
    }
}
