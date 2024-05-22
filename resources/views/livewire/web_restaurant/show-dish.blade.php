<div>
    <div class="fixed inset-0 z-40 bg-gray-900 bg-opacity-60 shadow-xl flex justify-center items-center">
        <div tabindex="-1" class="w-full md:w-4/5 p-4 overflow-x-hidden overflow-y-auto max-w-lg">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t-md bg-black">
                    <h3 class="text-xl font-medium text-gray-200">
                        Registrate
                    </h3>
                    <button wire:click="hideRegisterModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form wire:submit="register">
                    <!-- Email Address -->
                    <div class="p-6 space-y-3">

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-text-input :value="__('Email')" wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-text-input :value="__('Nombre')" wire:model="name" id="email" type="email" name="email" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-text-input :value="__('Apellidos')" wire:model="last_name" id="last_name" type="text" name="last_name" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-text-input :value="__('Número de teléfono')" wire:model="telephone_number" id="telephone_number" type="tel" name="telephone_number" required autofocus autocomplete="tel" />
                            <x-input-error :messages="$errors->get('')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-text-input :value="__('Contraseña')" wire:model="form.password" id="password"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-text-input :value="__('Repite la Contraseña')" wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                                {{ __('¿Ya estas registrado?') }}
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t bg-gray-100 border-gray-200 rounded-b">
                        <x-confirm-button wire:click='register'>Registrarse</x-confirm-button>
                        <x-decline-button wire:click='hideRegisterModal'>Cerrar</x-decline-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
