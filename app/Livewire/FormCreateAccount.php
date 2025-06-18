<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\User;

class FormCreateAccount extends Component
{

    public $name;
    public $email;
    public $telefone;
    public $cpf;
    public $type;

    public function mount()
    {
        $this->name = null;
        $this->email = null;
        $this->telefone = null;
        $this->cpf = null;
        $this->type = null;
    }

    public function render()
    {
        return view('livewire.form-create-account');
    }

    protected $rules = [
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:254',
        'cpf' => 'nullable|string|max:14',
        'telefone' => 'nullable|string|max:15',
        'type' => 'required|in:admin,func,guard',
    ];

    public function storeAccount()
    {
        $this->validate();

        $firstName = strtok($this->name, " ");
        $password = $this->cpf . "@" . $firstName;

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'telefone' => $this->telefone,
            'type' => $this->type,
            'password' => bcrypt($password),
        ]);

        $this->reset();

        session()->flash('successStoreAccount', 'Conta criada com sucesso');
        $this->dispatch('storeAccount');
    }
}
