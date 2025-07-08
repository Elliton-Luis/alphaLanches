<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
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
        $user = Auth::user();

        $users = $user->alunos()->get();
        $users->prepend($user);

        // Filtrar manualmente na Collection
        if ($this->filterName) {
            $users = $users->filter(function ($item) {
                return str_contains(strtolower($item->name), strtolower($this->filterName));
            })->values(); // reindexar a coleção
        }

        // Paginação manual
        $perPage = 5;
        $page = request()->get('page', 1);

        $paginated = new LengthAwarePaginator(
            $users->forPage($page, $perPage),
            $users->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('livewire.table-a-recharge-client', [
            'users' => $paginated,
        ]);
    }
}
