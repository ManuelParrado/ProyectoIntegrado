<div>
    <div>
        <div class="{{$isLoginModalVisible ? 'animate-fadeIn' : 'hidden'}} fixed inset-0 z-40 bg-gray-900 bg-opacity-60 shadow-xl flex justify-center items-center">
            <div tabindex="-1" class="w-full md:w-4/5 p-4 overflow-x-hidden overflow-y-auto max-w-lg">
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t-md bg-black">
                        <h3 class="text-xl font-medium text-gray-200">
                            Iniciar Sesión
                        </h3>
                        <button wire:click="hideLoginModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form wire:submit="login">
                        <!-- Email Address -->
                        <div class="p-6">
                            <div>
                                <x-text-input :value="__('Email')" wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-text-input :value="__('Contraseña')" wire:model="form.password" id="password"
                                                type="password"
                                                name="password"
                                                required autocomplete="current-password" />

                                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                            </div>

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember" class="inline-flex items-center">
                                    <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                                </label>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" wire:navigate>
                                        {{ __('¿Has olvidado tu contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t bg-gray-100 border-gray-200 rounded-b">
                            <x-confirm-button>Iniciar sesión</x-confirm-button>
                            <x-decline-button wire:click='hideLoginModal'>Cerrar</x-decline-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
