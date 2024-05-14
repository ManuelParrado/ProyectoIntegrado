<div>
    <div class="{{$isConfirmationModalVisible ? '' : 'hidden'}} shadow-xl fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-60 flex justify-center items-center">
        <div id="popup-modal" tabindex="-1" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-60 flex justify-center items-center">
            <div class="relative p-4 mx-auto max-w-md">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button" wire:click="hideConfirmationModal" class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-red-500 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500">
                            ¿Está seguro de que desea cancelar la reserva para el dia {{$reservationDate}} a las {{$reservationTimeslot}}?
                        </h3>
                        <div class="inline-flex justify-center">
                            <x-confirm-button wire:click='doCancelReservation'>Confirmar</x-confirm-button>
                            <x-decline-button wire:click='hideConfirmationModal'>Volver</x-decline-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
