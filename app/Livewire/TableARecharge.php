<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TableARecharge extends Component
{
    use WithPagination;

    public $filterName;
    public $filterType;
    public $userType;

    public function mount()
    {
        $this->userType = Auth::user()->type;
    }

    public function resetFilters()
    {
        $this->filterType = null;
        $this->filterName = null;
        $this->resetPage();
    }
    public function render()
    {
        $authUser = Auth::user();
        $query = User::query();

        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }

        if ($this->filterName) {
            $query->where('name', 'like', '%' . $this->filterName . '%');
        }

        if ($this->userType === 'guard') {
            $idsPermitidos = $authUser->alunos()->select('users.id')->pluck('id')->toArray();
            $idsPermitidos[] = $authUser->id;

            $query->whereIn('id', $idsPermitidos);
        }

        $users = $query->paginate(10);

        return view('livewire.table-a-recharge', ['users' => $users]);
    }
}