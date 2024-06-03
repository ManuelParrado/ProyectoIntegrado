<div>
    <div class="{{$isSearchModalVisible ? 'animate-fadeIn' : 'hidden'}} fixed inset-0 z-40 bg-gray-900 bg-opacity-60 shadow-xl flex justify-center items-center">
        <div tabindex="-1" class="w-full md:w-4/5 p-4 overflow-x-hidden overflow-y-auto max-w-lg">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t-md bg-black">
                    <h3 class="text-xl font-medium text-gray-200">
                        {{$modalTitle}}
                    </h3>
                    <button wire:click="closeAllModals" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="space-y-3 m-5">
                    <select wire:model='reservationTimeslot' id="reservationTimeslot" class="py-2.5 px-0 w-full text-sm text-gray-800 bg-transparent border-0 border-b-2 border-gray-700 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer" required>
                        <option selected disabled>Elige la hora de la reserva</option>
                        <option value="12:00 - 13:00">12:00 - 13:00</option>
                        <option value="13:00 - 14:00">13:00 - 14:00</option>
                        <option value="14:00 - 15:00">14:00 - 15:00</option>
                        <option value="15:00 - 16:00">15:00 - 16:00</option>
                        <option value="20:00 - 21:00">20:00 - 21:00</option>
                        <option value="21:00 - 22:00">21:00 - 22:00</option>
                        <option value="22:00 - 23:00">22:00 - 23:00</option>
                        <option value="23:00 - 00:00">23:00 - 00:00</option>
                    </select>
                    <label class='block' for="reservationDate">Seleccione el día de la reserva: </label>
                    <input wire:model='reservationDate' id="reservationDate" class="bg-gray-100 rounded-md focus:ring-gray-300" type='date' required>
                    <p class="text-red-500">{{$comprobationSearchErrorMessage}}</p>
                </form>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t bg-gray-100 border-gray-200 rounded-b">
                    <x-confirm-button wire:click='reserveComprobation'>Consultar</x-confirm-button>
                    <x-decline-button wire:click='hideSearchModal'>Cancelar</x-decline-button>
                </div>
            </div>
        </div>
    </div>

    <div class="{{$isReservationModalVisible ? 'animate-fadeIn' : 'hidden'}} fixed inset-0 z-40 bg-gray-900 bg-opacity-60 shadow-xl flex justify-center items-center">
        <div tabindex="-1" class="w-full md:w-4/5 p-4 overflow-x-hidden overflow-y-auto max-w-lg">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t-md bg-black">
                    <h3 class="text-xl font-medium text-gray-200">
                        Elija su mesa
                    </h3>
                    <button wire:click="closeAllModals" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="space-y-3 m-5 rounded-md">
                    <div class="flex flex-wrap p-2 justify-center items-center border-2 rounded-sm bg-gray-100 border-gray-700">
                        @foreach ($tables as $table)
                            @if (!$id_tables_reserved->contains($table->id))
                                <img tabindex="0" wire:click="showTableInformation({{ $table->id }})" class="w-20 m-2 rounded-lg focus:bg-gray-200 focus:scale-105 shadow-md transform transition-transform bg-white hover:scale-105 hover:bg-gray-200 duration-200 tabi" src="{{ asset('storage/images/table/table-image.png') }}">
                            @else
                                <img class="w-20 m-2 rounded-lg focus:bg-gray-200 focus:scale-105 shadow-md transform transition-transform bg-red-300" src="{{ asset('storage/images/table/table-image.png') }}">
                            @endif
                        @endforeach
                    </div>
                    <div class='text-md bg-gray-100 p-3'>
                        <p>Número de mesa: {{$tableNumber}}</p>
                        <p>Capacidad: {{$tableCapacity}}</p>
                        <p>Hora de la reserva: {{ \Illuminate\Support\Carbon::parse($reservationDate)->format('d/m/Y') }}</p>
                        <p>Hora de la reserva: {{$reservationTimeslot}}</p>
                    </div>
                    <p class="text-red-500">{{$comprobationReserveErrorMessage}}</p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t bg-gray-100 border-gray-200 rounded-b">
                    <x-confirm-button wire:click='showConfirmationModal'>Reservar</x-confirm-button>
                    <x-decline-button wire:click='hideReservationModal'>Volver</x-decline-button>
                </div>
            </div>
        </div>
    </div>

    <div class="{{$isConfirmationModalVisible ? '' : 'hidden'}} shadow-xl fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-60 flex justify-center items-center">
        <div id="popup-modal" tabindex="-1" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-60 flex justify-center items-center">
            <div class="relative p-4 mx-auto max-w-md">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button" wire:click="hideConfirmationModal" class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-red-500 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500">
                            @if ($isCreateMode)
                                Va a hacer una reserva de la mesa número {{$tableNumber}}
                                para {{$tableCapacity}} personas el día
                                {{\Illuminate\Support\Carbon::parse($reservationDate)->format('d/m/Y')}}
                                de {{$reservationTimeslot}} horas
                            @else
                                ¿Está seguro de que quiere editar su reserva?
                            @endif
                        </h3>
                        <div class="inline-flex justify-center">
                            <x-confirm-button wire:click='doReservation'>Confirmar</x-confirm-button>
                            <x-decline-button wire:click='hideConfirmationModal'>Volver</x-decline-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
