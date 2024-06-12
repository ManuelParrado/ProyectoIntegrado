<div>
    <div class="{{$isImageModalVisible ? 'fixed' : 'hidden'}} inset-0 z-50 bg-gray-900 bg-opacity-75 flex justify-center items-center">
        <div tabindex="-1" class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-4 overflow-hidden rounded-lg {{$isImageModalVisible ? 'animate-fadeIn' : ''}}">
            <div class="relative bg-black bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg shadow-xl">
                <!-- Modal header -->
                <div class="flex justify-end p-2">
                    <button wire:click="hideImageModal" type="button" class="rounded-full bg-gray-800 bg-opacity-50 p-2 hover:bg-opacity-75">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-2">
                    @if($image == null)
                        <div class="text-center text-white">
                            No se puede acceder a la imagen
                        </div>
                    @else
                        @if ($temporary)
                            <img class="w-full rounded-lg" src="{{ $image }}" alt="Imagen cargada">
                        @else
                            <img class="w-full rounded-lg" src="{{ asset('storage/' . $image) }}" alt="Imagen cargada">
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
