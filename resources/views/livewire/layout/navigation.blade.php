<div>
    <nav id="navbar" x-data="{ open: false }" class="nav bg-black shadow-lg p-1 text-lg">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl h-24 mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex justify-start">
                @auth
                    <a href="{{ route('welcome') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                @else
                    <a href="{{ route('welcome') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                @endauth
            </div>

            <!-- Enlaces a la derecha del logo -->
            <div class="flex items-center justify-end space-x-6">
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
                        Administrar
                    </x-nav-link>
                @endif
                <x-nav-link :href="route('dish.index')" :active="request()->routeIs('dish.index')">
                    Carta
                </x-nav-link>
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
                            <x-dropdown-link wire:click='showReservationModals'>
                                {{ __('Reservar mesa') }}
                            </x-dropdown-link>
                        </button>
                        <button class="w-full text-start">
                            <x-dropdown-link wire:click='logout'>
                                {{ __('Pedir a domicilio') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
                @auth
                    <a id="btn-message" class="button-message" href="{{ route('profile') }}">
                        <div class="content-avatar">
                            <div class="avatar">
                                <svg class="user-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,12.5c-3.04,0-5.5,1.73-5.5,3.5s2.46,3.5,5.5,3.5,5.5-1.73,5.5-3.5-2.46-3.5-5.5-3.5Zm0-.5c1.66,0,3-1.34,3-3s-1.34-3-3-3-3,1.34-3,3,1.34,3,3,3Z"></path></svg>
                            </div>
                        </div>
                        <div class="notice-content">
                            <div class="username">{{ auth()->user()->name }}</div>
                            <div class="lable-message">
                                {{ auth()->user()->name }}
                                <span class="number-message text-gray-200">
                                    <svg
                                        class="svg-icon"
                                        fill="none"
                                        height="20"
                                        viewBox="0 0 20 20"
                                        width="20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <g stroke="white" stroke-linecap="round" stroke-width="1.5">
                                        <circle cx="10" cy="10" r="2.5"></circle>
                                        <path
                                            clip-rule="evenodd"
                                            d="m8.39079 2.80235c.53842-1.51424 2.67991-1.51424 3.21831-.00001.3392.95358 1.4284 1.40477 2.3425.97027 1.4514-.68995 2.9657.82427 2.2758 2.27575-.4345.91407.0166 2.00334.9702 2.34248 1.5143.53842 1.5143 2.67996 0 3.21836-.9536.3391-1.4047 1.4284-.9702 2.3425.6899 1.4514-.8244 2.9656-2.2758 2.2757-.9141-.4345-2.0033.0167-2.3425.9703-.5384 1.5142-2.67989 1.5142-3.21831 0-.33914-.9536-1.4284-1.4048-2.34247-.9703-1.45148.6899-2.96571-.8243-2.27575-2.2757.43449-.9141-.01669-2.0034-.97028-2.3425-1.51422-.5384-1.51422-2.67994.00001-3.21836.95358-.33914 1.40476-1.42841.97027-2.34248-.68996-1.45148.82427-2.9657 2.27575-2.27575.91407.4345 2.00333-.01669 2.34247-.97026z"
                                            fill-rule="evenodd"
                                        ></path>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <div class="user-id">
                                {{ auth()->user()->email }}
                            </div>
                        </div>
                    </a>
                @else
                    <x-nav-link class="cursor-pointer" wire:click='showLoginModal'>
                        {{ __('Inicia Sesión') }}
                    </x-nav-link>
                    <x-nav-link class="cursor-pointer" wire:click='showRegisterModal'>
                        {{ __('Regístrate') }}
                    </x-nav-link>
                @endauth
            </div>
        </div>
    </nav>
</div>
