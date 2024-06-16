<div class="flex flex-col min-h-screen">
    <!-- Sidebar: se muestra a la izquierda -->
    <div class="flex flex-1"> <!-- Flex container para sidebar y contenido principal -->
        <!-- Sidebar -->
        <aside id="separator-sidebar" class="w-1/4 lg:w-1/6 font-semibold text-lg bg-gray-50 overflow-y-auto">
            <div class="px-3 py-4">
                <ul class="space-y-2">
                    <li>
                        <button wire:click="showProfileView" class="flex w-full items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z" clip-rule="evenodd"/>
                            </svg>
                            <span class="ml-3">Perfil</span>
                        </button>
                    </li>
                    <li class="border-t border-black">
                        <button wire:click="showReservationView" class="flex w-full mt-2 items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" clip-rule="evenodd"/>
                            </svg>
                            <span class="ml-3">Mis Reservas</span>
                        </button>
                    </li>
                    <li class="border-t border-black">
                        <button wire:click="showOrderView" class="flex w-full mt-2 items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v9a1 1 0 0 0 1 1h.535a3.5 3.5 0 1 0 6.93 0h3.07a3.5 3.5 0 1 0 6.93 0H21a1 1 0 0 0 1-1v-4a.999.999 0 0 0-.106-.447l-2-4A1 1 0 0 0 19 6h-5a2 2 0 0 0-2-2H4Zm14.192 11.59.016.02a1.5 1.5 0 1 1-.016-.021Zm-10 0 .016.02a1.5 1.5 0 1 1-.016-.021Zm5.806-5.572v-2.02h4.396l1 2.02h-5.396Z" clip-rule="evenodd"/>
                            </svg>
                            <span class="ml-3">Mis Pedidos</span>
                        </button>
                    </li>
                    @if (Auth::check() && Auth::user()->role === 'admin')
                    <li class="border-t border-black">
                        <a href="{{ route('admin.index') }}" class="flex w-full mt-2 items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10.83 5a3.001 3.001 0 0 0-5.66 0H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17ZM4 11h9.17a3.001 3.001 0 0 1 5.66 0H20a1 1 0 1 1 0 2h-1.17a3.001 3.001 0 0 1-5.66 0H4a1 1 0 1 1 0-2Zm1.17 6H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17a3.001 3.001 0 0 0-5.66 0Z"/>
                            </svg>
                            <span class="ml-3">Administrar</span>
                        </a>
                    </li>
                    @endif
                    <li class="border-t border-black">
                        <button wire:click="showConfirmationLogoutModal" class="flex w-full mt-2 items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
                            </svg>
                            <span class="ml-3">Cerrar Sesión</span>
                        </button>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Contenido principal -->
        <div class="flex-1 p-4 overflow-y-auto">
            @if ($isReservationViewVisible)
                <livewire:showreservations />
            @elseif ($isProfileViewVisible)
                <livewire:showprofile />
            @elseif ($isOrderViewVisible)
                <livewire:showorders />
            @endif
        </div>
    </div>

    <livewire:showconfirmationoperationmodal />
</div>
