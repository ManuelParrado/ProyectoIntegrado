<div>
    <div class="{{$isEditTableModalVisible ? 'animate-fadeIn' : 'hidden'}} fixed inset-0 z-40 bg-gray-900 bg-opacity-60 shadow-xl flex justify-center items-center">
        <div tabindex="-1" class="w-full md:w-4/5 p-4 overflow-x-hidden overflow-y-auto max-w-lg">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t-md bg-black">
                    <h3 class="text-xl font-medium text-gray-200">
                        Editar Mesa
                    </h3>
                    <button wire:click="hideEditTableModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
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

                        <div>
                            <x-text-input value='{{$number}}' :label="__('Número de mesa')" wire:model="number" id="number" type="number" name="number" required autofocus autocomplete="number" />
                            <x-input-error :messages="$errors->get('number')" class="mt-2" />
                        </div>

                        <div>
                            <x-text-input value='{{$capacity}}' :label="__('Capacidad')" wire:model="capacity" id="capacity" type="number" name="capacity" required autofocus autocomplete="capacity" />
                            <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                        </div>

                    </div>
                    <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t bg-gray-100 border-gray-200 rounded-b">
                        <x-confirm-button type="button" wire:click='editTable'>Editar</x-confirm-button>
                        <x-decline-button type="button" wire:click='hideEditTableModal'>Cerrar</x-decline-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

