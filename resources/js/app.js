import './bootstrap';
import 'flowbite';
import Datepicker from 'flowbite-datepicker/Datepicker';

document.addEventListener('DOMContentLoaded', function () {
    const datepickerEl = document.getElementById('datepicker');
    if (datepickerEl) {
        new Datepicker(datepickerEl, {
            // Puedes agregar opciones aquí
        });
    }
});
