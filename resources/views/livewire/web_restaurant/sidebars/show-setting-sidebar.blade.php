<div>
<aside id="separator-sidebar" class="fixed top-24 left-0 z-20 w-1/5 text-lg h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
        <ul class="space-y-2 font-medium">
            <li>
            <button wire:click='showProfileView' class="flex w-full items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                    <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                    <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ms-3">Perfil</span>
            </button>
            </li>
            <li class="border-t border-black">
            <button wire:click='showReservationView' class="flex w-full mt-2 items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                    <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                    <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ms-3">Reservas</span>
            </button>
            </li>
            <li class="border-t border-black">
                <button  class="flex w-full mt-2 items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                    <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                    <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ms-3">Pedidos</span>
                </button>
            </li>
            <li class="border-t border-black">
                <button wire:click='showConfirmationLogoutModal' class="flex w-full mt-2 items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                    <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                    <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ms-3">Cerrar Sesión</span>
                </button>
            </li>
        </ul>
    </div>
</aside>

<div class="p-4 sm:ml-64">
    @if ($isReservationViewVisible == true)
        <livewire:showreservations />
    @endif
    @if ($isProfileViewVisible == true)
        <livewire:showprofile />
    @endif
</div>

<livewire:showconfirmationoperationmodal />

</div>