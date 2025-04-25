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

    public function storeAccount()
    {

        if (User::where('email', $this->email)->exists()) {
            session()->flash('errorStoreAccount', 'Email já cadastrado');
        } elseif (!empty($this->cpf) && User::where('cpf', $this->cpf)->exists()) {
            session()->flash('errorStoreAccount', 'CPF já cadastrado');
        } elseif (!empty($this->telefone) && User::where('telefone', $this->telefone)->exists()) {
            session()->flash('errorStoreAccount', 'Telefone já cadastrado');
        } else {
            $firstName = strtok($this->name, " ");
            $password = $this->cpf . "@" . $firstName;

            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'cpf' => $this->cpf,
                'telefone' => $this->telefone,
                'type' => $this->type,
                'password' => bcrypt($password)
            ]);

            $this->reset();
            session()->flash('successStoreAccount', 'Conta criada com sucesso');
            $this->dispatch('storeAccount');
        }

    }



}
