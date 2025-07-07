<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CreditLog;

class ModalHistoricoCreditos extends Component
{
    use WithPagination;

    public $userId;
    public $nome;

    public function render()
    {
        $query = CreditLog::query();

        $creditsLogs = $query->paginate(5);

        return view('livewire.modal-historico-creditos', ['creditsLogs' => $creditsLogs]);
    }
}