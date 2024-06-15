<div>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="flex flex-col">
                    <!-- Hero Section -->
                    <div class="relative animate-fadeIn">
                        <img src="{{ asset('storage/images/esthetic-images/principal.jpg') }}" class="block w-full h-full object-cover" alt="Plato destacado">
                        <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
                            <div class="text-center text-white p-4">
                                <h1 class="text-4xl font-bold mb-2">Bienvenidos a Web Restaurant</h1>
                                <p class="text-xl mb-4">Descubre el placer de los sabores de verdad</p>
                                <x-confirm-button wire:click="showReservationTableModal">
                                    RESERVA TU MESA
                                </x-confirm-button>
                            </div>
                        </div>
                    </div>

                    <!-- About Section -->
                    <div class="text-center p-8">
                        <h2 class="text-3xl font-bold mb-4">Nuestro amor por la buena comida</h2>
                        <p class="text-lg">En Web Restaurant, cada receta es un homenaje a la tradición culinaria, adaptada con un toque moderno para deleitar tu paladar. Experimenta la perfecta armonía entre innovación y clásicos gastronómicos, cocinados a la perfección por nuestros expertos chefs utilizando ingredientes frescos y locales.</p>
                    </div>

                    <!-- Image Gallery -->
                    <div class="grid grid-cols-3 gap-4 p-8">
                        <a href="{{ route('dish.index') }}" class="infocard cursor-pointer">
                            <div class="infocard-details">
                                <img class="rounded-md" src="{{ asset('storage/images/esthetic-images/taco.jpg') }}" alt="Plato de temporada">
                            </div>
                            <button class="infocard-button mt-4 text-white font-semibold py-2 px-4 rounded">Explora nuestro menú</button>
                        </a>
                        <a href="{{ route('dish.index') }}" class="infocard cursor-pointer">
                            <div class="infocard-details">
                                <img class="rounded-md" src="{{ asset('storage/images/esthetic-images/hamburguesa.jpg') }}" alt="Especialidades del chef">
                            </div>
                            <button class="infocard-button mt-4 text-white font-semibold py-2 px-4 rounded">Conoce las especialidades</button>
                        </a>
                        <div wire:click="showReservationTableModal" class="infocard cursor-pointer">
                            <div class="infocard-details">
                                <img class="rounded-md" src="{{ asset('storage/images/esthetic-images/instalaciones.jpg') }}" alt="Ambiente del restaurante">
                            </div>
                            <button class="infocard-button mt-4 text-white font-semibold py-2 px-4 rounded">Visita nuestro espacio</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
