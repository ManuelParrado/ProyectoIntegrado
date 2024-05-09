<?php

namespace App\Livewire;

use App\Models\Table;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowTable extends Component
{

    public $tables;
    public $selectedTableInformation = null;
    public $selectedTableClass = null;
    public $reservationDate;
    public $reservationTimeslot;
    public $errorMessage = '';
    public $errorMessageClass = '';
    public $modalIsOpen = false;

    public function openModal()
    {
        $this->modalIsOpen = true;
    }

    public function closeModal()
    {
        $this->modalIsOpen = false;
    }

    public function mount()
    {
        $this->tables = Table::all();
    }

    public function render()
    {
        return view('livewire.web_restaurant.show-table');
    }

    public function showTableInformation($table_id)
    {
        $table = Table::find($table_id);

        $this->selectedTableInformation = array(
            'id_table' => $table->id,
            'capacity' => $table->capacity,
            'number' => $table->number
        );
    }

    public function reserveComprobation()
    {
        if ($this->selectedTableInformation != null && $this->reservationTimeslot != null) {
            $this->errorMessage = '';
            $this->errorMessageClass = '';

            $comprobationTable = DB::table('user_table')
                ->where('id_table', '=', $this->selectedTableInformation['id_table'])
                ->where('date', '=', $this->reservationDate)
                ->where('timeslot', '=', $this->reservationTimeslot)
                ->get();

            if ($comprobationTable->isNotEmpty()) {
                $this->errorMessage = 'Esta mesa ha sido reservada';
                $this->errorMessageClass = 'text-red-500 text-md';
            } else {
                $this->errorMessage = 'Esta mesa está disponible para reservar';
                $this->errorMessageClass = 'text-green-500 text-md';
            }
        } else {
            $this->errorMessage = 'Seleccione todos los datos para hacer la reserva';
            $this->errorMessageClass = 'text-red-500 text-md';
        }
    }
}
