<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class TableARecharge extends Component
{
    public function render()
    {
        $query = User::query();

        $users = $query->paginate(10);

        return view('livewire.table-a-recharge', ['users' => $users]);
    }
}
