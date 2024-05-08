<div>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden py-3 shadow-sm sm:rounded-lg">
               <div class="flex col-sm-2 space-x-10 bg-gray-200 shadow-md p-3 rounded-sm">
                    <div class="flex flex-wrap justify-center p-2 items-center w-2/5 bg-gray-100 rounded-md">
                        @foreach ($tables as $table)
                            <img wire:click='showTableInformation({{ $table->id }})' class="w-24 m-2 rounded-lg focus:bg-gray-200 focus:scale-105 shadow-md transform transition-transform hover:scale-105 hover:bg-gray-200 duration-200 tabi" src="{{ asset('storage/images/table/table-image.png') }}">
                        @endforeach
                    </div>
                    <div class="w-1/2">
                        <h2 class="text-center text-lg">Horario de cena</h2>
                        <form wire:submit.prevent="reserveComprobation" class="space-y-3">
                            <select wire:model='reservationTimeslot' id="reservationTimeslot" class="block py-2.5 px-0 w-full text-sm text-gray-800 bg-transparent border-0 border-b-2 border-gray-700 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer" required>
                                <option selected>Elige la hora de la reserva</option>
                                <option value="20:00 - 21:00">20:00 - 21:00</option>
                                <option value="21:00 - 22:00">21:00 - 22:00</option>
                                <option value="22:00 - 23:00">22:00 - 23:00</option>
                                <option value="23:00 - 00:00">23:00 - 00:00</option>
                            </select>
                            <div class="flex col-sm-2 space-x-3">
                                <div>
                                    <label class='block' for="reservationDate">Seleccione el día de la reserva: </label>
                                    <input wire:model='reservationDate' id="reservationDate" class="bg-gray-100 rounded-md focus:ring-gray-300" type='date' required>
                                </div>
                                <div class="px-3">
                                    <button  type="submit" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Consultar mesa</button>
                                </div>
                            </div>
                            <div>
                                @if(isset($selectedTableInformation) && $selectedTableInformation != null)
                                <p>Capacidad: {{$selectedTableInformation['capacity']}}</p>
                                <p>Numero de mesa: {{$selectedTableInformation['number']}}</p>
                                @endif
                            </div>
                        </form>
                        <p class="{{ $errorMessageClass }}">
                            {{ $errorMessage }}
                        </p>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
