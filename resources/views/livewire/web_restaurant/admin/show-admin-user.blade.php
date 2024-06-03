<div class="{{$isUserAdministration ? '' : 'hidden'}}">
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-lg">
            <h1 class="text-3xl font-bold text-gray-800 p-2">Administracion de usuarios</h1>
            <div class="flex overflow-hidden shadow-md rounded-md bg-gray-200">
                <aside id="separator-sidebar" class="bg-gray-50 p-4 w-1/3" aria-label="Sidebar">
                    <div class="h-full overflow-y-auto">
                        <ul class="space-y-2 font-medium">
                            <li>
                                <div class="container">
                                    <form>
                                        <label>
                                            <input type="radio" wire:click='searchUsers' wire:model='filter' value='all' name="radio" checked>
                                            <span>Todos los usuarios</span>
                                        </label>
                                        <label>
                                            <input type="radio" wire:click='searchUsers' wire:model='filter' value='admin' name="radio">
                                            <span>Administradores</span>
                                        </label>
                                        <label>
                                            <input type="radio" wire:click='searchUsers' wire:model='filter' value='user' name="radio">
                                            <span>Usuarios</span>
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
                            <x-text-input wire:model.live='search' for="search" :label="__('Buscar usuario')" />
                            <button wire:click='clearSearch' class='cross'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                                </svg>
                            </button>
                        </div>
                        <div class="flex w-full text-{{$confirmationColor}}-500 text-center">
                            {{$confirmationMessage}}
                        </div>
                        @if($users->count() == 0)
                            <p class="bg-gray-50 p-4 w-full shadow-md rounded-md flex justify-around items-center">No se encuentran usuarios</p>
                        @else
                            @foreach ($users as $user)
                                <div class="bg-gray-50 py-4 px-6 w-auto shadow-md rounded-md flex justify-between items-center">
                                    <div class="inline-grid w-1/2">
                                        <p class="pb-3"><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                                        <p class="pb-3"><span class="font-semibold">Nombre:</span> {{ $user->name }}</p>
                                        <p class="pb-3"><span class="font-semibold">Apellidos:</span> {{ $user->last_name }}</p>
                                        <p class="pb-3"><span class="font-semibold">Número de teléfono:</span> {{ $user->telephone_number }}</p>
                                        <p class="pb-3"><span class="font-semibold">Permisos:</span>
                                            @if($user->role === 'admin')
                                                Administrador
                                            @else
                                                Usuario
                                            @endif
                                        </p>
                                        <p class="pb-3"><span class="font-semibold">Registro:</span> {{ $user->created_at->format('d/m/Y H:i:s') }}</p>
                                        <p class="pb-3"><span class="font-semibold">Última edición:</span> {{ $user->updated_at->format('d/m/Y H:i:s') }}</p>
                                        <p class="pb-3">
                                            <span class="font-semibold">Eliminado:</span>
                                            @if ($user->deleted_at != null)
                                                Sí {{ $user->last_name }}
                                            @else
                                                No
                                            @endif
                                        </p>
                                    </div>
                                    @if ($user->deleted_at == null)
                                        <div class="space-y-3 p-6 flex-row items-center">
                                            <x-edit-button wire:click='openEditUserModal({{ json_encode($user) }})'>Editar</x-edit-button>
                                            <x-delete-button wire:click='showConfirmationModal({{ $user->id }})'>Eliminar</x-delete-button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            {{ $users->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:showeditusermodal />
</div>
