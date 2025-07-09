<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\CreditLog;

class ModalEditRecargaNegativo extends Component
{
    public $userId;
    public $nome;
    public $saldoAtual;
    public $valor = '';
    public $metodo = '';
    public $mostrarInfo = false;

    public function render()
    {
        return view('livewire.modal-edit-recarga-negativo');
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

    public function realizarRetirada()
    {
        $this->validate([
            'valor' => 'required|numeric|gt:0|lte:999.99',
        ], [
            'valor.required' => 'Informe o valor.',
            'valor.numeric' => 'O valor deve ser numérico.',
            'valor.gt' => 'O valor deve ser maior que zero.',
            'valor.lte' => 'O valor deve ser menor que R$ 999,99.',
        ]);

        $valorFloat = floatval($this->valor);

        $user = User::find($this->userId);

        if (!$user) {
            $this->addError('user', 'Usuário não encontrado.');
            return;
        }

        $user->credit -= $valorFloat;

        if ($user->credit < 0)
            $user->credit = 0;

        $user->save();

        CreditLog::create([
            'user_id' => $user->id,
            'valor' => $valorFloat,
            'tipo' => 'saida',
            'metodo_pagamento' => $this->metodo,
            'executado_por' => auth()->id(),
        ]);

        $this->saldoAtual = $user->credit;
        $this->reset(['valor', 'metodo', 'mostrarInfo']);
        return redirect(request()->header('Referer'));
    }
}
