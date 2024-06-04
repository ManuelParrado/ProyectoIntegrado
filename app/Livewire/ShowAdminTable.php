<?php

namespace App\Livewire;

use App\Models\Table;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAdminTable extends Component
{
    use WithPagination;

    public $isTableAdministration = true;
    public $search;

    public function mount()
    {
        $this->searchTables();
    }

    public function render()
    {
        $tables = $this->searchTables();
        return view('livewire.web_restaurant.admin.show-admin-table', ['tables' => $tables]);
    }

    public function searchTables()
    {
        return Table::where('number', 'like', '%' . $this->search . '%')
            ->orWhere('capacity', 'like', '%' . $this->search . '%')
            ->orWhere('created_at', 'like', '%' . $this->search . '%')
            ->orWhere('updated_at', 'like', '%' . $this->search . '%')
            ->paginate(5);
    }

    public function openEditTableModal($table)
    {
        $this->dispatch('showEditTableModal', ['table' => $table]);
    }

    #[On('showTableAdministration')]
    public function showTableAdministration()
    {
        $this->isTableAdministration = true;
    }

    #[On('hideTableAdministration')]
    public function hideTableAdministration()
    {
        $this->isTableAdministration = false;
    }
}
