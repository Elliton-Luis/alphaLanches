<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CreditLog;

class ModalHistoricoCreditos extends Component
{
    public $userId;
    public $nome;
    public $historico = [];

    public function mount($userId, $nome)
    {
        $this->userId = $userId;
        $this->nome = $nome;
        $this->carregarHistorico();
    }

    public function carregarHistorico()
    {
        $this->historico = CreditLog::with('executor')
            ->where('user_id', $this->userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function render()
    {
        return view('livewire.modal-historico-creditos');
    }
}
