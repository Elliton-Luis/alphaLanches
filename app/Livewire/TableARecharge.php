<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class TableARecharge extends Component
{
    use WithPagination;
    public $filterName;
    public $filterType;
    public function resetFilters()
    {
        $this->filterType = null;
        $this->filterName = null;
        $this->resetPage();
    }
    public function render()
    {
        $query = User::query();

        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }

        if ($this->filterName) {
            $query->where('name', 'like', "%" . $this->filterName . "%");
        }

        $users = $query->paginate(10);

        return view('livewire.table-a-recharge', ['users' => $users]);
    }
}
