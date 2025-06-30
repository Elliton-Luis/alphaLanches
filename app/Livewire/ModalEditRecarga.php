<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\CreditLog;

class ModalEditRecarga extends Component
{
    public $userId;
    public $nome;
    public $saldoAtual;
    public $valor = '';
    public $metodo = '';
    public $mostrarInfo = false;
    public $mensagem = '';

    public function mount($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $this->userId = $user->id;
            $this->nome = $user->name;
            $this->saldoAtual = $user->credit;
        }
    }

    public function render()
    {
        return view('livewire.modal-edit-recarga');
    }

    public function digitar($tecla)
    {
        if ($tecla === 'C') {
            $this->valor = '';
            return;
        }

        if ($tecla === '.' && str_contains($this->valor, '.')) {
            return;
        }

        if (!str_contains($this->valor, '.') && strlen($this->valor) >= 3 && $tecla !== '.') {
            return;
        }

        if (str_contains($this->valor, '.')) {
            [$inteiro, $decimal] = explode('.', $this->valor);
            if (strlen($decimal) >= 2) {
                return;
            }
        }

        $this->valor .= $tecla;
    }

    public function selecionarMetodo($metodo)
    {
        $this->metodo = $metodo;
        $this->mostrarInfo = true;
    }

    public function realizarRecarga()
    {
        $valorFloat = floatval($this->valor);

        if ($valorFloat <= 0 || !$this->metodo) {
            $this->addError('valor', 'Preencha valor e método.');
            return;
        }

        $user = User::find($this->userId);

        if (!$user) {
            $this->addError('user', 'Usuário não encontrado.');
            return;
        }

        $user->credit += $valorFloat;
        $user->save();

        CreditLog::create([
            'user_id' => $user->id,
            'valor' => $valorFloat,
            'tipo' => 'entrada',
            'metodo_pagamento' => $this->metodo,
            'executado_por' => auth()->id(),
        ]);

        $this->saldoAtual = $user->credit;
        $this->reset(['valor', 'metodo', 'mostrarInfo', 'mensagem']);
    }
}
