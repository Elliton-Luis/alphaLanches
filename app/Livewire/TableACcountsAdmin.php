<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\User;

class TableACcountsAdmin extends Component
{

    use WithPagination;

    protected $listeners = ['storeAccount' => 'render'];

    public $filterName;
    public $filterTelefone;
    public $filterType;

    public $editUserId;
    public $editName;
    public $editTelefone;
    public $editType;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->filterName = null;
        $this->filterTelefone = null;
        $this->filterType = null;
    }

    public function render()
    {
        $query = User::query();

        $query->where('id', '!=', auth()->id());

        if ($this->filterName) {
            $query->where('name', 'like', '%' . $this->filterName . '%');
        }

        if ($this->filterTelefone) {
            $query->where('telefone', 'like', '%' . $this->filterTelefone . '%');
        }

        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }

        $users = $query->paginate(5);

        return view('livewire.table-a-ccounts-admin', ['users' => $users]);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (auth()->id() == $id) {
            session()->flash('error', 'Ação Não Autorizada!');
            return;
        }

        if ($user->type === 'student') {
            $user->responsaveis()->detach();
        }

        if ($user->type === 'guard') {
            $user->alunos()->detach();
        }

        if ($user) {
            $user->delete();
            session()->flash('success', 'Usuário excluído com sucesso!');
        }
    }

    public function editUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->editUserId = $user->id;
            $this->editName = $user->name;
            $this->editTelefone = $user->telefone;
            $this->editType = $user->type;

            $this->dispatch('showEditModal');
        }
    }

    public function updateUser()
    {
        $this->validate([
            'editName' => 'required|max:254',
            'editTelefone' => 'nullable|string|max:15',
        ]);

        $user = User::find($this->editUserId);

        if ($user) {
            $user->update([
                'name' => $this->editName,
                'telefone' => $this->editTelefone,
                'type' => $this->editType,
            ]);

            session()->flash('success', 'Usuário atualizado com sucesso!');

            $this->reset(['editUserId', 'editName', 'editTelefone', 'editType']);
            $this->dispatch('hideEditModal');
        }

        return redirect()->route('painel.usuarios')->with('success', 'Usuário atualizado com sucesso!');
    }
}
