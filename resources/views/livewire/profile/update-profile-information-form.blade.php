<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $last_name = '';
    public string $telephone_number = '';
    public string $image = '';
    public $new_image = '';
    public $image_key = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->last_name = Auth::user()->last_name;
        $this->telephone_number = Auth::user()->telephone_number;
        $this->image = Auth::user()->image;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
     public function updateProfileInformation(): void
    {
        $user = Auth::user();

        // Validate all input data including the image
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'new_image' => ['nullable', 'image', 'max:1024'], // Ensure this is nullable if the image is optional
            'last_name' => ['required', 'string', 'max:255'],
            'telephone_number' => ['required', 'numeric', 'max_digits:9'],
        ]);

        // Update user data
        $user->fill([
            'name' => $validated['name'],
            'last_name' => $validated['last_name'],
            'telephone_number' => $validated['telephone_number'],
            'email' => $validated['email'],
        ]);

        if ($this->new_image) {
            $path = $this->new_image->store('images/user', 'public');
            $user->image = $path;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->image_key = rand(); // Refresh image key to force re-render on the client-side

        $this->dispatch('profile-updated', name: $user->name);

        // Optionally, reset new_image to prevent re-uploading on subsequent unrelated form submissions
        $this->reset('new_image');
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    public function showDishImage()
    {
        // Comprobamos si 'new_image' es una instancia de TemporaryUploadedFile
        if ($this->new_image) {
            $temporaryUrl = $this->new_image->temporaryUrl();
            $this->dispatch('showImageModal', image: $temporaryUrl, temporary: true);
        } else {
            // En caso de que no haya un archivo o no sea el tipo esperado
            $this->dispatch('showImageModal', image: $this->old_image, temporary: false);
        }
    }

}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Información del Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Actualiza la información del perfil de tu cuenta.") }}
        </p>
    </header>

    <div class="w-1/3 mt-6">
        <img class="rounded-full h-40 w-40 object-cover" src="{{ asset('storage/' . Auth::user()->image) }}">
    </div>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">

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
                <label class="block mb-2 text-base font-medium text-gray-900" for="file_input">Cambiar imagen de perfil</label>
                <input wire:key='{{$image_key}}' wire:model='new_image' class="block w-full text-base text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" id="file_input" type="file" accept="image/*">
                <x-input-error :messages="$errors->get('new_image')" class="mt-2" />
            </div>

            @if($new_image)
                <input type="button" class="flex align-self-start pb-3 hover:underline font-semibold cursor-pointer" wire:click="showDishImage" value="Ver Nueva Imagen de Perfil">
            @endif

            <!-- Progress Bar -->
            <div x-show="uploading" class="w-full">
                Cargando ...
            </div>
        </div>

        <div>
            <x-text-input :label="__('Nombre')" wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-text-input :label="__('Apellidos')" wire:model="last_name" id="last_name" type="text" name="last_name" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-text-input :label="__('Número de teléfono')" wire:model="telephone_number" id="telephone_number" type="tel" name="telephone_number" required autofocus autocomplete="tel" />
            <x-input-error :messages="$errors->get('telephone_number')" class="mt-2" />
        </div>

        <div>
            <x-text-input :label="__('Email')" wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-confirm-button>{{ __('Guardar') }}</x-confirm-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Perfil Modificado.') }}
            </x-action-message>
        </div>
    </form>
</section>
