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

    protected $listeners = ['abrirHistorico'];
    public function abrirHistorico($userId, $nome)
    {
        $this->userId = $userId;
        $this->nome = $nome;
        $this->resetPage();
    }

    public function render()
    {
        $query = CreditLog::query();

        $creditsLogs = $query->paginate(5);

        return view('livewire.modal-historico-creditos', ['creditsLogs' => $creditsLogs]);
    }
}