<div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-lg">
            <h1 class="text-3xl font-bold text-gray-800 p-2">Mis Reservas</h1>
            <div class="flex overflow-hidden shadow-md rounded-md bg-gray-200">
                <aside id="separator-sidebar" class="bg-gray-50 p-4 w-1/3" aria-label="Sidebar">
                    <div class="h-full overflow-y-auto">
                        <ul class="space-y-2 font-medium">
                            <li>
                                <div class="container">
                                    <form>
                                        <label>
                                            <input type="radio" wire:click='searchReservations' wire:model='filter' value='all' name="radio" checked>
                                            <span>Todas las reservas</span>
                                        </label>
                                        <label>
                                            <input type="radio" wire:click='searchReservations' wire:model='filter' value='active' name="radio" >
                                            <span>Reservas activas</span>
                                        </label>
                                        <label>
                                            <input type="radio" wire:click='searchReservations' wire:model='filter' value='cancelled' name="radio">
                                            <span>Cancelaciones</span>
                                        </label>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </aside>
                <div class="w-full h-auto flex justify-center items-center">
                    <div class="w-2/3 p-4 h-full space-y-4 flex-row text-lg">
                        @if($reservations->count() == 0)
                            <p class="bg-gray-50 p-4 w-full shadow-md rounded-md flex justify-around items-center">No se encuentran reservas</p>
                        @else
                            @foreach ($reservations as $reservation)
                                <div class="bg-gray-50 py-4 px-6 w-full shadow-md rounded-md flex justify-around items-center">
                                    <div class="inline-grid w-full">
                                        <p class="pb-3"><span class="font-semibold">Fecha de la reserva: </span>{{\Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y')}}</p>
                                        <p><span class="font-semibold">Día: </span>{{\Carbon\Carbon::parse($reservation->date)->format('d/m/Y')}}</p>
                                        <p><span class="font-semibold">Hora: </span>{{$reservation->timeslot}}</p>
                                        <p><span class="font-semibold">Número de mesa: </span>{{$reservation->number}}</p>
                                        <p><span class="font-semibold">Capacidad: </span>{{$reservation->capacity}}</p>
                                        @if ($reservation->deleted_at != null)
                                            <span class="text-red-500 font-bold">Cancelada el día {{\Carbon\Carbon::parse($reservation->updated_at)->format('d/m/Y')}}</span>
                                        @else
                                            <span class="text-green-500 font-bold">Activa</span>
                                        @endif
                                    </div>
                                    @if ($reservation->deleted_at == null)
                                        <div class="space-y-3 flex-row items-center">
                                            <x-edit-button wire:click='showSearchReservationModal({{ $reservation->id }})'>Cambiar</x-edit-button>
                                            <x-delete-button wire:click='showConfirmationDeleteModal({{ json_encode($reservation) }})'>Cancelar</x-delete-button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            {{ $reservations->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:showcancelreservationmodal />
</div>
