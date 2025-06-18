<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class TableARecharge extends Component
{
    use WithPagination;
    public $userId;
    public $nome;
    public $saldoAtual;
    public $valor = '';
    public $metodo = '';
    public $mostrarInfo = false;

    protected $listeners = ['abrirModalRecarga' => 'abrirModal'];

    public function abrirModal($id, $nome, $saldo)
    {
        $this->userId = $id;
        $this->nome = $nome;
        $this->saldoAtual = $saldo;
        $this->valor = '';
        $this->metodo = '';
        $this->mostrarInfo = false;

        $this->dispatchBrowserEvent('abrirModalRecarga');
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
            if (strlen($decimal) >= 2)
                return;
        }

        $this->valor .= $tecla;
    }

    public function selecionarPagamento($metodo)
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

        // Aqui você atualiza o banco (exemplo)
        $user = User::find($this->userId);
        $user->saldo += $valorFloat;
        $user->save();

        session()->flash('mensagem', 'Recarga realizada com sucesso!');

        $this->dispatchBrowserEvent('fecharModalRecarga');
    }
    public function render()
    {
        $query = User::query();

        $users = $query->paginate(10);

        return view('livewire.table-a-recharge', ['users' => $users]);
    }
}
