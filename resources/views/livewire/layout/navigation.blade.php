<div>
    <nav x-data="{ open: false }" class="bg-black shadow-lg p-1">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-24">
            <!-- Enlaces a la izquierda del logo -->
            <div class="flex items-center space-x-6">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-lg">
                    {{ __('Entrantes') }}
                </x-nav-link>
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-lg">
                    {{ __('Principales') }}
                </x-nav-link>
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-lg">
                    {{ __('Postres') }}
                </x-nav-link>
            </div>

            <!-- Logo -->
            <div class="flex items-center">
                @auth
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                @else
                    <a href="{{ route('welcome') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                @endauth
            </div>

            <!-- Enlaces a la derecha del logo -->
            <div class="flex items-center space-x-6">
                <x-dropdown align="bottom" width="48">
                    <x-slot name="trigger">
                        <div class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-lg font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out cursor-pointer">
                            {{ __('Reservas') }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                            </svg>
                        </div>
                    </x-slot>

                    <x-slot name="content">
                        <button class="w-full text-start">
                            <x-dropdown-link class="text-lg">
                                {{ __('Reservar mesa') }}
                            </x-dropdown-link>
                        </button>
                        <button class="w-full text-start">
                            <x-dropdown-link class="text-lg">
                                {{ __('Pedir a domicilio') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-lg">
                    {{ __('Inicia Sesión') }}
                </x-nav-link>
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-lg">
                    {{ __('Regístrate') }}
                </x-nav-link>
            </div>
        </div>
    </nav>
</div>
