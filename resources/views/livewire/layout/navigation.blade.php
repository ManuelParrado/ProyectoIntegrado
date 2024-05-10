<div>
    <nav id="navbar" x-data="{ open: false }" class="nav bg-black shadow-lg p-1 text-lg">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl h-24 mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex justify-start">
                @auth
                    <a href="{{ route('welcome') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                @else
                    <a href="{{ route('welcome') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                @endauth
            </div>

            <!-- Enlaces a la derecha del logo -->
            <div class="flex items-center justify-end space-x-6">
                <x-dropdown align="bottom" width="48">
                    <x-slot name="trigger">
                        <div class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out cursor-pointer">
                            {{ __('Reservas') }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                            </svg>
                        </div>
                    </x-slot>

                    <x-slot name="content">
                        <button class="w-full text-start">
                            <x-dropdown-link wire:click='showSearchModal'>
                                {{ __('Reservar mesa') }}
                            </x-dropdown-link>
                        </button>
                        <button class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Pedir a domicilio') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500  bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
                @else
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')" wire:navigate>
                        {{ __('Inicia Sesión') }}
                    </x-nav-link>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')" wire:navigate>
                        {{ __('Regístrate') }}
                    </x-nav-link>
                @endauth
            </div>
        </div>
    </nav>

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
                    <p class="text-red-500">{{$comprobationSearchErrorMessage}}</p>
                </form>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t bg-gray-100 border-gray-200 rounded-b">
                    <button wire:click="reserveComprobation" type="button" class="text-white bg-black hover:bg-gray-700 focus:ring-4 transition duration-150 hover:scale-105 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Consultar</button>
                    <button wire:click="hideSearchModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-200 transition duration-150 hover:scale-105  hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-400">Volver</button>
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
                    <button wire:click="showConfirmationModal" type="button" class="text-white bg-black hover:bg-gray-700 focus:ring-4 transition duration-150 hover:scale-105 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Reservar</button>
                    <button wire:click="hideReservationModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-200 transition duration-150 hover:scale-105  hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-400">Volver</button>
                </div>
            </div>
        </div>
    </div>

    <div class="{{$isConfirmationModalVisible ? '' : 'hidden'}} shadow-xl fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-60 flex justify-center items-center">
        <div id="popup-modal" tabindex="-1" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-60 flex justify-center items-center">
            <div class="relative p-4 mx-auto max-w-md">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button" class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-red-500 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500">Va a hacer una reserva de la mesa número {{$tableNumber}} para {{$tableCapacity}} personas el día {{\Illuminate\Support\Carbon::parse($reservationDate)->format('d/m/Y')}} de {{$reservationTimeslot}} horas</h3>
                        <button wire:click="doReservation" type="button" class="text-white bg-black hover:bg-gray-700 focus:ring-4 transition duration-150 hover:scale-105 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Confirmar</button>
                        <button wire:click="hideConfirmationModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-200 transition duration-150 hover:scale-105  hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-400">Volver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
