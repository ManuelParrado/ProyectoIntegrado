<div class="{{$isReservationAdministration ? '' : 'hidden'}}">
    <div class="py-2">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8 text-lg">
            <h1 class="text-3xl font-bold text-gray-800 p-2">Administracion de reservas</h1>
            <div class="flex overflow-hidden shadow-md rounded-md bg-gray-200 ">
                <aside id="separator-sidebar" class="bg-gray-50 p-4 w-1/3" aria-label="Sidebar">
                    <div class="h-full overflow-y-auto">
                        <ul class="space-y-2 font-medium">
                            <li class="mb-4">
                                <label class='block' for="calendar1">Seleccione un día: </label>
                                <input type="date" wire:model.live='selected_date' id="calendar1" class="bg-gray-100 rounded-md focus:ring-gray-300">
                            </li>
                            <li>
                                <div class="container">
                                    <form>
                                        <label>
                                            <input type="radio" wire:click='setFilter("all")' name="radio" checked>
                                            <span>Todos los horarios</span>
                                        </label>
                                        <label>
                                            <input type="radio" wire:click='setFilter("day")'' name="radio">
                                            <span>Horario de día</span>
                                        </label>
                                        <label>
                                            <input type="radio" wire:click='setFilter("night")' value="night" name="radio">
                                            <span>Horario de noche</span>
                                        </label>
                                    </form>
                                </div>
                            </li>
                            <li class="border-t border-black pt-3">
                                <div class="container">
                                    <form>
                                        <label>
                                            <input type="radio" wire:click='setStatusFilter("all")' name="radio2" checked>
                                            <span>Todas las reservas</span>
                                        </label>
                                        <label>
                                            <input type="radio" wire:click='setStatusFilter("active")'' name="radio2">
                                            <span>Reservas activas</span>
                                        </label>
                                        <label>
                                            <input type="radio" wire:click='setStatusFilter("cancelled")' name="radio2">
                                            <span>Reservas canceladas</span>
                                        </label>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </aside>
                <div class="w-full h-auto flex justify-center items-center">
                    <div class="w-full p-4 h-full space-y-4 flex-row text-lg">
                        @if($groupedReservations->isEmpty())
                            <div class="bg-gray-50 p-4 w-full shadow-md rounded-md flex justify-around items-center">
                                Ninguna reserva para el día {{\Illuminate\Support\Carbon::parse($selected_date)->format('d/m/Y')}}
                            </div>
                        @else
                            <div class="bg-gray-50 p-4 w-full shadow-md rounded-md flex justify-around items-center">
                                Total de personas: {{$totalCapacity}}
                            </div>
                            @foreach($groupedReservations as $timeslot => $reservations)
                                @php $totalCapacityByTimeslot = 0; @endphp
                                @foreach($reservations as $reservation)
                                    @php
                                    if ($reservation->deleted_at == null)
                                        $totalCapacityByTimeslot += $reservation->table_capacity;
                                    @endphp
                                @endforeach
                                <div class="space-y-2">
                                    <button onclick="collapse('dropdown-{{ $selected_date }}-{{ str_replace(' ', '', $timeslot) }}')"
                                        id='button-{{ $selected_date }}-{{ str_replace(' ', '', $timeslot) }}'
                                        type="button"
                                        class="bg-gray-50 py-4 px-6 w-full shadow-md rounded-md flex justify-between items-center cursor-pointer">
                                        <h2>{{ $timeslot }} - Personas: {{$totalCapacityByTimeslot}}</h2>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                                            </svg>
                                        </div>
                                    </button>
                                    <ul id="dropdown-{{ $selected_date }}-{{ str_replace(' ', '', $timeslot) }}" class="hidden">
                                        @foreach($reservations as $reservation)
                                            <div class="bg-gray-50 py-4 px-6 ml-6 my-2 w-auto shadow-md flex justify-between">
                                                <div class="flex-row items-center">
                                                    <li>
                                                        <span class="font-semibold">Nombre:</span> {{ $reservation->user_name }} {{ $reservation->user_last_name }}
                                                    </li>
                                                    <li>
                                                        <span class="font-semibold">Email:</span> {{ $reservation->user_email }}
                                                    </li>
                                                    <li>
                                                        <span class="font-semibold">Teléfono de contacto:</span> {{ $reservation->user_telephone }}
                                                    </li>
                                                    <li>
                                                        <span class="font-semibold">Número de mesa:</span> {{ $reservation->table_number }}
                                                    </li>
                                                    <li>
                                                        <span class="font-semibold">Capacidad:</span> {{ $reservation->table_capacity }}
                                                    </li>
                                                    <li>
                                                        <span class="font-semibold">Fecha de la reserva:</span> {{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y H:i:s') }}
                                                    </li>
                                                    <li>
                                                        <span class="font-semibold">Última modificación:</span> {{ \Carbon\Carbon::parse($reservation->updated_at)->format('d/m/Y H:i:s')  }}
                                                    </li>
                                                    @if ($reservation->deleted_at != null)
                                                        <li>
                                                            <span class="text-red-500 font-bold">Cancelada el día {{\Carbon\Carbon::parse($reservation->updated_at)->format('d/m/Y')}}</span>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <span class="text-green-500 font-bold">Activa</span>
                                                        </li>
                                                    @endif
                                                </div>
                                                @if($reservation->deleted_at == null)
                                                    <div class="flex-row content-center space-y-3 p-3">
                                                        <x-edit-button wire:click='showSearchReservationModal({{ $reservation->id }})'>Cambiar</x-edit-button>
                                                        <x-delete-button wire:click='showConfirmationDeleteModal({{ json_encode($reservation) }})'>Cancelar</x-delete-button>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <livewire:showcancelreservationmodal />
    </div>
    <script>
        function collapse(id) {
            var dropdown = document.getElementById(id);
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }
    </script>
</div>
