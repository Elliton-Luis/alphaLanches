<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        'email' => 'required|email|max:254|unique:users,email',
        'cpf' => 'nullable|string|max:14|unique:users,cpf',
        'telefone' => 'nullable|string|max:15',
        'type' => 'required|in:admin,func,guard,student',
    ];

    protected function messages()
    {
        return [
            'cpf.unique' => 'CPF já existe!',
            'email.unique' => 'Email já existe!',
        ];
    }

    public function storeAccount()
    {
        if (Auth::user()->type === 'guard') {
            $this->type = 'student';
        }

        $this->validate();

        $firstName = strtok($this->name, " ");
        $password = $this->cpf . "@" . $firstName;

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'telefone' => $this->telefone,
            'type' => $this->type,
            'password' => bcrypt($password),
        ]);

        if (Auth::user()->type === 'guard') {
            Auth::user()->alunos()->attach($user->id);
        }

        $this->reset();

        session()->flash('successStoreAccount', 'Conta criada com sucesso');
        $this->dispatch('storeAccount');
    }
}
