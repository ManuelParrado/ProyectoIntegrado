<div class="{{$isReservationAdministration ? '' : 'hidden'}}">
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-lg">
            <h1 class="text-3xl font-bold text-gray-800 p-2">Administracion de reservas</h1>
            <div class="flex overflow-hidden shadow-md rounded-md bg-gray-200">
                <aside id="separator-sidebar" class="bg-gray-50 p-4 w-1/3" aria-label="Sidebar">
                    <div class="h-full overflow-y-auto">
                        <ul class="space-y-2 font-medium">
                            <li>
                                {{ $selected_date }}
                            </li>
                            <li>
                                <div class="relative max-w-sm">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input id='datepicker' datepicker  type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Selecciona el día">
                                </div>
                            </li>
                        </ul>
                    </div>
                </aside>
                <div class="w-full h-auto flex justify-center items-center">
                    <div class="w-full p-4 h-full space-y-4 flex-row text-lg">
                        @if($reservations->count() == 0)
                        <p class="bg-gray-50 p-4 w-full shadow-md rounded-md flex justify-around items-center">Ninguna reserva para el día {{$selected_date}}</p>
                        @else
                            @foreach ($reservations as $reservation)
                            <div class="bg-gray-50 py-4 px-6 w-auto shadow-md rounded-md flex justify-between items-center">
                                {{$reservation->timeslot}}
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @script
    <script>
        const datepickerEl = document.getElementById('datepicker');

        datepickerEl.addEventListener('changeDate', (event) => {
            const date = new Date(event.detail.date);

            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();

            $wire.dispatch('dateSelected', { date: `${month}-${day}-${year}` }, false);

            cleanup();
        });
    </script>
    @endscript
</div>
