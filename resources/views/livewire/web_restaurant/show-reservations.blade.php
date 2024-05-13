<div>
<div class="py-12">
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
                                        <input type="radio" wire:click='setFilterAll' name="radio" checked>
                                        <span>Todas las reservas</span>
                                    </label>
                                    <label>
                                        <input type="radio" wire:click='setFilterActive' name="radio" >
                                        <span>Reservas activas</span>
                                    </label>
                                    <label>
                                        <input type="radio" wire:click='setFilterCancelled' name="radio">
                                        <span>Cancelaciones</span>
                                    </label>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </aside>
            <div class="w-auto p-4 h-full space-y-4 ">
                @if($reservations->count() == 0)
                    <p>No hay reservas disponibles.</p>
                @else
                    @foreach ($reservations as $reservation)
                        <div class="bg-gray-50 p-4 w-auto shadow-md rounded-sm flex justify-center items-center space-x-5">
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
                            <div class="flex-wrap space-y-3">
                                <x-edit-button>Editar</x-edit-button>
                                <x-delete-button >Cancelar</x-delete-button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
</div>
