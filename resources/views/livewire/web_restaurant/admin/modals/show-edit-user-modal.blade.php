<div>
    <div class="{{$isEditUserModalVisible ? 'animate-fadeIn' : 'hidden'}} fixed inset-0 z-40 bg-gray-900 bg-opacity-60 shadow-xl flex justify-center items-center">
        <div tabindex="-1" class="w-full md:w-4/5 p-4 overflow-x-hidden overflow-y-auto max-w-lg">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t-md bg-black">
                    <h3 class="text-xl font-medium text-gray-200">
                        Editar Usuario
                    </h3>
                    <button wire:click="hideEditUserModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form wire:submit="editUser">
                    <!-- Email Address -->
                    <div class="px-6 py-3 space-y-3">

                        <!-- Email Address -->
                        <div>
                            <x-text-input value='{{$email}}' :label="__('Email')" wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-text-input value='{{$name}}' :label="__('Nombre')" wire:model="name" id="name" type="text" name="name" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-text-input value='{{$last_name}}' :label="__('Apellidos')" wire:model="last_name" id="last_name" type="text" name="last_name" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-text-input value='{{$telephone_number}}' :label="__('Número de teléfono')" wire:model="telephone_number" id="telephone_number" type="tel" name="telephone_number" required autofocus autocomplete="tel" />
                            <x-input-error :messages="$errors->get('telephone_number')" class="mt-2" />
                        </div>

                        <div>
                            <label for="role" class="select_label">Permisos</label>
                            <select wire:model='role' id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="user">Usuario</option>
                                <option value="admin">Administrador</option>
                            </select>
                        </div>

                    </div>
                    <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t bg-gray-100 border-gray-200 rounded-b">
                        <x-confirm-button wire:click='editUser'>Editar</x-confirm-button>
                        <x-decline-button wire:click='hideEditUserModal'>Cerrar</x-decline-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
