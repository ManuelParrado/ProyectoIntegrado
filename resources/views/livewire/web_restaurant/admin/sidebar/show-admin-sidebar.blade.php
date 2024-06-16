<aside id="separator-sidebar" class="w-1/4 lg:w-1/6 font-semibold text-lg bg-gray-50 overflow-y-auto">
    <div class="px-3 py-4">
        <ul class="space-y-2">
            <li>
            <button wire:click='showReservationAdministration' class="flex w-full items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" clip-rule="evenodd"/>
                </svg>
                <span class="ms-3">Reservas</span>
            </button>
            </li>
            <li class="border-t border-black">
                <button wire:click='showDishAdministration' class="flex w-full mt-2 items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="2" fill="none"/>
                        <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                    <span class="ms-3">Platos</span>
                </button>
            </li>
            <li class="border-t border-black">
                <button wire:click='showTableAdministration' class="flex w-full mt-2 items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <rect x="4" y="6" width="16" height="2" fill="currentColor"/>
                        <rect x="6" y="8" width="2" height="10" fill="currentColor"/>
                        <rect x="16" y="8" width="2" height="10" fill="currentColor"/>
                    </svg>
                    <span class="ms-3">Mesas</span>
                </button>
            </li>
            <li class="border-t border-black">
                <button wire:click='showUserAdministration' class="flex w-full mt-2 items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M17 10v1.126c.367.095.714.24 1.032.428l.796-.797 1.415 1.415-.797.796c.188.318.333.665.428 1.032H21v2h-1.126c-.095.367-.24.714-.428 1.032l.797.796-1.415 1.415-.796-.797a3.979 3.979 0 0 1-1.032.428V20h-2v-1.126a3.977 3.977 0 0 1-1.032-.428l-.796.797-1.415-1.415.797-.796A3.975 3.975 0 0 1 12.126 16H11v-2h1.126c.095-.367.24-.714.428-1.032l-.797-.796 1.415-1.415.796.797A3.977 3.977 0 0 1 15 11.126V10h2Zm.406 3.578.016.016c.354.358.574.85.578 1.392v.028a2 2 0 0 1-3.409 1.406l-.01-.012a2 2 0 0 1 2.826-2.83ZM5 8a4 4 0 1 1 7.938.703 7.029 7.029 0 0 0-3.235 3.235A4 4 0 0 1 5 8Zm4.29 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h6.101A6.979 6.979 0 0 1 9 15c0-.695.101-1.366.29-2Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ms-3">Usuarios</span>
                </button>
            </li>
            <li class="border-t border-black">
                <button wire:click='showOrderAdministration' class="flex w-full mt-2 items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v9a1 1 0 0 0 1 1h.535a3.5 3.5 0 1 0 6.93 0h3.07a3.5 3.5 0 1 0 6.93 0H21a1 1 0 0 0 1-1v-4a.999.999 0 0 0-.106-.447l-2-4A1 1 0 0 0 19 6h-5a2 2 0 0 0-2-2H4Zm14.192 11.59.016.02a1.5 1.5 0 1 1-.016-.021Zm-10 0 .016.02a1.5 1.5 0 1 1-.016-.021Zm5.806-5.572v-2.02h4.396l1 2.02h-5.396Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ms-3">Pedidos</span>
                </button>
            </li>
        </ul>
    </div>
</aside>

