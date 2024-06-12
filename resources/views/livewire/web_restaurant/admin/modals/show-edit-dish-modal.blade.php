<div>
    <div class="{{$isEditDishModalVisible ? 'animate-fadeIn' : 'hidden'}} fixed inset-0 z-40 bg-gray-900 bg-opacity-60 shadow-xl flex justify-center items-center">
        <div tabindex="-1" class="w-full md:w-4/5 p-4 overflow-x-hidden overflow-y-auto max-w-lg">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t-md bg-black">
                    <h3 class="text-xl font-medium text-gray-200">
                        Editar Plato
                    </h3>
                    <button wire:click="hideEditDishModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form wire:submit="editDish">
                    <!-- Email Address -->
                    <div class="px-6 py-3 space-y-3">

                        <!-- Email Address -->
                        <div>
                            <x-text-input value='{{$name}}' :label="__('Nombre')" wire:model="name" id="name" type="text" name="name" required autofocus autocomplete="off" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <label for="type" class="select_label">Tipo de plato</label>
                            <select wire:model='type' id="type" class="bg-gray-50 font-semibold text-base border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                                <option value="appetizer">Entrante</option>
                                <option value="main_course">Plato Principal</option>
                                <option value="dessert">Postre</option>
                                <option value="drink">Bebida</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <div>
                            <x-text-input value='{{$price}}' :label="__('Precio')" wire:model="price" id="price" type="text" name="price" required autofocus autocomplete="off" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div>
                            <label for="visibility_status" class="select_label">Visibilidad</label>
                            <select wire:model='visibility_status' id="visibility_status" class="bg-gray-50 font-semibold text-base border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                                <option value="visible">Visible</option>
                                <option value="hidden">Oculto</option>
                            </select>
                            <x-input-error :messages="$errors->get('visibility_status')" class="mt-2" />
                        </div>

                        <div
                            x-data="{ uploading: false, progress: 0 }"
                            x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false"
                            x-on:livewire-upload-cancel="uploading = false"
                            x-on:livewire-upload-error="uploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"

                            class="w-full"
                        >
                            <!-- File Input -->
                            <div class="mb-3 mt-3">
                                <label class="block mb-2 text-base font-medium text-gray-900" for="file_input">Subir imagen</label>
                                <input wire:key='{{$image_key}}' wire:model='new_image' class="block w-full text-base text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" id="file_input" type="file" >
                                <x-input-error :messages="$errors->get('new_image')" class="mt-2" />
                            </div>

                            @if($new_image)
                                <input type="button" class="flex align-self-start pb-3 hover:underline font-semibold" wire:click="showDishImage" value="Ver Imagen">
                            @endif

                            <!-- Progress Bar -->
                            <div x-show="uploading" class="w-full">
                                Cargando ...
                            </div>
                        </div>


                    </div>
                    <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t bg-gray-100 border-gray-200 rounded-b">
                        <x-confirm-button type="submit">Editar</x-confirm-button>
                        <x-decline-button type="button" wire:click='hideEditDishModal'>Cerrar</x-decline-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
