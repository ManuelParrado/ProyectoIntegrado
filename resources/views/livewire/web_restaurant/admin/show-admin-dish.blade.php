<div class="{{$isDishAdministration ? '' : 'hidden'}}"0>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-lg">
            <h1 class="text-3xl font-bold text-gray-800 p-2">Administracion de platos</h1>
            <div class="flex overflow-hidden shadow-md rounded-md bg-gray-200">
                <aside id="separator-sidebar" class="bg-gray-50 p-4 w-1/3" aria-label="Sidebar">
                    <div class="h-full overflow-y-auto">
                        <ul class="space-y-2 font-medium">
                            <li class="mb-5">
                                <x-add-button wire:click='showCreateDishModal' >Añadir</x-add-button>
                            </li>
                            <li>
                                <div class="container">
                                    <form>
                                        <label>
                                            <input type="radio" wire:click='searchDishes' wire:model='filter' value='all' name="radio" checked>
                                            <span>Todos los platos</span>
                                        </label>
                                        <label>
                                            <input type="radio" wire:click='searchDishes' wire:model='filter' value='appetizer' name="radio">
                                            <span>Entrantes</span>
                                        </label>
                                        <label>
                                            <input type="radio" wire:click='searchDishes' wire:model='filter' value='main_course' name="radio">
                                            <span>Platos Principales</span>
                                        </label>
                                        <label>
                                            <input type="radio" wire:click='searchDishes' wire:model='filter' value='dessert' name="radio">
                                            <span>Postres</span>
                                        </label>
                                        <label>
                                            <input type="radio" wire:click='searchDishes' wire:model='filter' value='drink' name="radio">
                                            <span>Bebidas</span>
                                        </label>
                                    </form>
                                </div>
                            </li>
                            <li class="border-t border-black pt-3">
                                <div class="container">
                                    <form>
                                        <label>
                                            <input type="radio" wire:click='searchDishes' wire:model='statusFilter' value='all' name="radio2" checked>
                                            <span>Todos los estados</span>
                                        </label>
                                        <label>
                                            <input type="radio" wire:click='searchDishes' wire:model='statusFilter' value='visible' name="radio2">
                                            <span>Visibles</span>
                                        </label>
                                        <label>
                                            <input type="radio" wire:click='searchDishes' wire:model='statusFilter' value='hidden' name="radio2">
                                            <span>No Visibles</span>
                                        </label>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </aside>
                <div class="w-full h-auto flex justify-center items-center">
                    <div class="w-full p-4 h-full space-y-4 flex-row text-lg">
                        <div class="flex justify-around">
                            <x-text-input wire:model.live='search' for="search" :label="__('Buscar platos')" />
                            <button wire:click='clearSearch' class='cross'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                                </svg>
                            </button>
                        </div>
                        @if($dishes->count() == 0)
                            <p class="bg-gray-50 p-4 w-full shadow-md rounded-md flex justify-around items-center">No se encuentran platos</p>
                        @else
                            @foreach ($dishes as $dish)
                                <div class="bg-gray-50 py-4 px-6 w-auto shadow-md rounded-md flex justify-between items-center">
                                    <div class="inline-grid w-1/2">
                                        <p class="pb-3"><span class="font-semibold">Nombre:</span> {{ $dish->name }}</p>
                                        <p class="pb-3"><span class="font-semibold">Tipo:</span>
                                            @switch($dish->type)
                                                @case('appetizer')
                                                    Entrante
                                                    @break
                                                @case('main_course')
                                                    Plato Principal
                                                    @break
                                                @case('dessert')
                                                    Postre
                                                    @break
                                                @case('drink')
                                                    Bebida
                                                    @break
                                            @endswitch
                                        </p>
                                        <p class="pb-3"><span class="font-semibold">Precio:</span> {{ $dish->price }}</p>
                                        <input type="button" class="flex align-self-start pb-3 hover:underline font-semibold" wire:click="showDishImage('{{ $dish->image }}')" value="Ver Imagen">
                                        <p class="pb-3 font-semibold">Visibilidad:
                                            @if ($dish->visibility_status != null)
                                                <span class="text-red-500 font-bold">Ocultado el {{\Carbon\Carbon::parse($dish->visibility_at)->format('d/m/Y')}}</span>
                                            @else
                                                <span class="text-green-500 font-bold">Activa</span>
                                            @endif
                                        </p>
                                        <p class="pb-3"><span class="font-semibold">Creado el:</span> {{ \Carbon\Carbon::parse($dish->created_at)->format('d/m/Y H:i:s') }}</p>
                                        <p class="pb-3"><span class="font-semibold">Modificado el:</span> {{ \Carbon\Carbon::parse($dish->updated_at)->format('d/m/Y H:i:s') }}</p>
                                    </div>
                                    <div class="flex-row content-center space-y-3 p-3">
                                        <x-edit-button wire:click='showEditDishModal({{ $dish }})' >Editar</x-edit-button>
                                        <x-delete-button wire:click='showConfirmationModal({{ $dish->id }})' >Eliminar</x-delete-button>
                                    </div>
                                </div>
                            @endforeach
                            {{ $dishes->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:showeditdishmodal />
    <livewire:showcreatedishmodal />
</div>

