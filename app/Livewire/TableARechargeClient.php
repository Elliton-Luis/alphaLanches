<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TableARechargeClient extends Component
{
    use WithPagination;
    protected $listeners = ['storeAccount' => 'render'];
    public $filterName;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->filterName = null;
    }
    public function render()
    {
        $query = Auth::User()->alunos();

        if ($this->filterName) {
            $query->where('users.name', 'like', '%' . $this->filterName . '%');
        }

        $users = $query->paginate(5);

        return view('livewire.table-a-recharge-client', ['users' => $users]);
    }
}
