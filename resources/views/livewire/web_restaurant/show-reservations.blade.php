<div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 p-2">Mis Reservas</h1>
            <div class="flex overflow-hidden shadow-md rounded-md bg-gray-200">
                <aside id="separator-sidebar" class="bg-gray-50 p-4 w-1/4" aria-label="Sidebar">
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
                <div class="w-full flex justify-center items-center">
                    <div class="w-2/3 p-4 h-full space-y-4 flex-row text-center text-lg">
                        @if($reservations->count() == 0)
                            <p class="bg-gray-50 p-2 shadow-md rounded-sm">No se encuentran reservas</p>
                        @else
                            @foreach ($reservations as $reservation)
                                <div class="bg-gray-50 p-4 w-full shadow-md rounded-sm space-x-5 flex justify-around">
                                    <div>
                                        <span class="block">Fecha de reserva: {{\Carbon\Carbon::parse($reservation->pivot->date)->format('d/m/Y')}}</span>
                                        <span class="block">Hora: {{$reservation->pivot->timeslot}}</span>
                                        <span class="block">Número de mesa: {{$reservation->number}}</span>
                                        <span class="block">Capacidad: {{$reservation->capacity}}</span>
                                        @if ($reservation->pivot->deleted_at != null)
                                            <span class="block text-red-500 font-bold">Cancelada</span>
                                        @else
                                            <span class="block text-green-500 font-bold">Activa</span>
                                        @endif
                                    </div>
                                    @if ($reservation->pivot->deleted_at == null)
                                        <div class="space-y-3 flex-row items-center">
                                            <x-edit-button>Editar</x-edit-button>
                                            <x-delete-button wire:click='showDeleteModal({{$reservation}})'>Cancelar</x-delete-button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:showcancelreservationmodal />
</div>
