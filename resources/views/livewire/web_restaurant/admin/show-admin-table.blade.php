<div class="{{$isTableAdministration ? '' : 'hidden'}}">
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-lg">
            <h1 class="text-3xl font-bold text-gray-800 p-2">Administracion de mesas</h1>
            <div class="flex overflow-hidden shadow-md rounded-md bg-gray-200 ">
                <aside id="separator-sidebar" class="bg-gray-50 p-4 w-1/3" aria-label="Sidebar">
                    <div class="h-full overflow-y-auto">
                        <ul class="space-y-2 font-medium">
                            <li class="mb-4">
                                <x-text-input wire:model.live='search' for="search" :label="__('Buscar mesa')" />
                            </li>
                            <li class="flex justify-center">
                                <x-add-button wire:click='openCreateTableModal'>Añadir</x-add-button>
                            </li>
                        </ul>
                    </div>
                </aside>
                <div class="w-full h-auto flex justify-center items-center">
                    <div class="w-full p-4 h-full space-y-4 flex-row text-lg">
                        @if($tables->isEmpty())
                        <div class="bg-gray-50 p-4 w-full shadow-md rounded-md flex justify-around items-center">
                            No se encuentra niguna mesa
                        </div>
                        @else
                            @foreach ($tables as $table)
                            <div class="bg-gray-50 py-4 px-6 w-auto shadow-md rounded-md flex justify-between items-center">
                                <div class="inline-grid w-1/2">
                                    <p class="pb-3"><span class="font-semibold">Número de mesa:</span> {{ $table->number }}</p>
                                    <p class="pb-3"><span class="font-semibold">Capacidad:</span> {{ $table->capacity }}</p>
                                    <p class="pb-3"><span class="font-semibold">Fecha de creación:</span> {{ \Carbon\Carbon::parse($table->created_at)->format('d/m/Y H:i:s') }}</p>
                                    <p class="pb-3"><span class="font-semibold">Última modificación:</span> {{ \Carbon\Carbon::parse($table->created_at)->format('d/m/Y H:i:s') }}</p>
                                </div>
                                <div class="space-y-3 p-6 flex-row items-center">
                                    <x-edit-button wire:click='openEditTableModal({{ json_encode($table) }})' >Editar</x-edit-button>
                                    <x-delete-button wire:click='showConfirmationModal({{ $table->id }})'>Eliminar</x-delete-button>
                                </div>
                            </div>
                            @endforeach
                            {{$tables->links()}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:showcreatetablemodal />
    <livewire:showedittablemodal />
</div>
