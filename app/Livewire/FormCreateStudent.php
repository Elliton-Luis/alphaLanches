<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FormCreateStudent extends Component
{
    public function render()
    {
        return view('livewire.form-create-student');
    }

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

    protected $rules = [
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:254|unique:users,email',
        'cpf' => 'nullable|string|max:14|unique:users,cpf',
        'telefone' => 'nullable|string|max:15',
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
        $this->validate();

        $firstName = strtok($this->name, " ");
        $password = $this->cpf . "@" . $firstName;

        $student = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'telefone' => $this->telefone,
            'type' => 'student',
            'password' => bcrypt($password),
        ]);

        Auth::user()->alunos()->attach($student->id);

        $this->reset();

        session()->flash('successStoreAccount', 'Conta criada com sucesso');
        $this->dispatch('storeAccount');
    }
}
