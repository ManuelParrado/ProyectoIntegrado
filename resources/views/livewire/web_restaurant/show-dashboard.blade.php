<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center overflow-hidden shadow-sm sm:rounded-sm">
                <div class="flex items-center justify-center w-1/2 bg-gray-300 text-gray-800 px-6 py-12 text-xl mx-1 rounded-md shadow-md">
                    <div class="flex items-center justify-center w-1/2 bg-black text-gray-200 p-6 rounded-sm">
                        Pida a domicilio
                    </div>
                </div>
                <div class="flex items-center min-h-svh justify-center w-1/2 bg-black text-gray-200 p-6 py-12 text-xl mx-1 rounded-md shadow-md">
                    <div class="flex items-center justify-center w-1/2 bg-gray-300 text-gray-800 p-6 rounded-sm">
                        <button wire:click='showSearchModal'>Reserve una mesa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal reservar mesa  -->
    <div class="{{$isSearchModalVisible ? 'animate-fadeIn' : 'hidden'}} fixed inset-0 z-40 bg-gray-900 bg-opacity-60 shadow-xl flex justify-center items-center">
        <div tabindex="-1" class="w-full md:w-4/5 p-4 overflow-x-hidden overflow-y-auto max-w-lg">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t-md bg-black">
                    <h3 class="text-xl font-medium text-gray-200">
                        Horario de cena
                    </h3>
                    <button wire:click="hideSearchModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
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
                        <option value="20:00 - 21:00">20:00 - 21:00</option>
                        <option value="21:00 - 22:00">21:00 - 22:00</option>
                        <option value="22:00 - 23:00">22:00 - 23:00</option>
                        <option value="23:00 - 00:00">23:00 - 00:00</option>
                    </select>
                    <label class='block' for="reservationDate">Seleccione el día de la reserva: </label>
                    <input wire:model='reservationDate' id="reservationDate" class="bg-gray-100 rounded-md focus:ring-gray-300" type='date' required>
                    <p class="text-red-500">{{$comprationReserverErrorMessage}}</p>
                </form>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t bg-gray-100 border-gray-200 rounded-b">
                    <button wire:click="reserveComprobation" type="button" class="text-white bg-black hover:bg-gray-700 focus:ring-4 transition duration-150 hover:scale-105 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Consultar</button>
                    <button wire:click="hideSearchModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-200 transition duration-150 hover:scale-105  hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-400">Cerrar</button>
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
                    <button wire:click="hideReservationModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
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
                                <img wire:click="showTableInformation({{ $table->id }})" class="w-20 m-2 rounded-lg focus:bg-gray-200 focus:scale-105 shadow-md transform transition-transform hover:scale-105 hover:bg-gray-200 duration-200 tabi" src="{{ asset('storage/images/table/table-image.png') }}">
                            @else
                                <img class="w-20 m-2 rounded-lg focus:bg-gray-200 focus:scale-105 shadow-md transform transition-transform bg-red-300" src="{{ asset('storage/images/table/table-image.png') }}">
                            @endif
                        @endforeach
                    </div>
                    <div class='text-md bg-gray-100 p-3'>
                        <p>Número de mesa: {{$tableNumber}}</p>
                        <p>Capacidad: {{$tableCapacity}}</p>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t bg-gray-100 border-gray-200 rounded-b">
                    <button wire:click="hideReservationModal" type="button" class="text-white bg-black hover:bg-gray-700 focus:ring-4 transition duration-150 hover:scale-105 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Reservar</button>
                    <button wire:click="hideReservationModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-200 transition duration-150 hover:scale-105  hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-400">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</div>
