<div>
    <nav x-data="{ open: false }" class="bg-black shadow-lg p-1 text-lg">
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
                            <x-dropdown-link>
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
</div>
