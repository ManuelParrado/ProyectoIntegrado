<div tabindex="-1" class="w-full md:w-4/5 p-4 overflow-x-hidden overflow-y-auto max-w-lg">
    <div class="relative bg-white rounded-lg shadow">
        <!-- Modal header -->
        <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t-md bg-black">
            <h3 class="text-xl font-medium text-gray-200">
                Elija su mesa
            </h3>
            <button wire:click="hideSearchModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!-- Modal body -->
        <div class="space-y-3 m-5 bg-gray-100 rounded-md">
            <div class="flex flex-wrap p-2 justify-center items-center border-2 rounded-sm border-gray-700">
                @foreach ($tables as $table)
                    <img wire:click='showTableInformation({{ $table->id }})' class="w-20 m-2 rounded-lg focus:bg-gray-200 focus:scale-105 shadow-md transform transition-transform hover:scale-105 hover:bg-gray-200 duration-200 tabi" src="{{ asset('storage/images/table/table-image.png') }}">
                @endforeach
            </div>
            <div class='text-md'>
                <p>Número de mesa: </p>
                <p>Capacidad: </p>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t bg-gray-100 border-gray-200 rounded-b">
            <button wire:click="hideSearchModal" type="button" class="text-white bg-black hover:bg-gray-700 focus:ring-4 transition duration-150 hover:scale-105 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Reservar</button>
            <button wire:click="hideSearchModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-200 transition duration-150 hover:scale-105  hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-400">Cerrar</button>
        </div>
    </div>
</div>
