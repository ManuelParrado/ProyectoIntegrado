<footer class="bg-black text-white py-8">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-semibold">Sobre Nosotros</h3>
                <p class="mt-4 text-gray-400">
                    Somos una combinación única de hamburguesería y taquería ofreciendo sabores innovadores y tradicionales.
                </p>
                <p class="mt-4 text-gray-400">
                    Nos encontramos en C. Salinas, 6, Distrito Centro, 29015 Málaga
                </p>
            </div>
            <div>
                <h3 class="text-lg font-semibold">Enlaces Rápidos</h3>
                <ul class="mt-4">
                    <li><a href="{{ route('welcome') }}" class="text-gray-400 hover:text-gray-200 transition-colors">Inicio</a></li>
                    <li><a href="{{ route('dish.index') }}" class="text-gray-400 hover:text-gray-200 transition-colors">Menú</a></li>
                    <li><button wire:click='showReservationModal' class="text-gray-400 hover:text-gray-200 transition-colors">Reservar</button></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold">Contáctanos</h3>
                <ul class="mt-4">
                    <li class="text-gray-400">Tel: +123 456 7890</li>
                    <li class="text-gray-400">Email: info@webrestaurant.com</li>
                </ul>
                <div class="flex mt-4">
                    <a href="#" class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path fill="#2F2F38" fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    <a href="#" class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path fill="#383838" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    <a href="#" class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path fill="#383838" d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center text-gray-500 mt-8">
            © 2024 Web Restaurant. Todos los derechos reservados.
        </div>
    </div>
</footer>
