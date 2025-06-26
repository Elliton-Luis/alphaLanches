<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TableStudentsGuard extends Component
{
    use WithPagination;

    protected $listeners = ['storeAccount' => 'render'];

    public $filterName;
    public $filterTelefone;

    public $editUserId;
    public $editName;
    public $editTelefone;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->filterName = null;
        $this->filterTelefone = null;
    }

    public function render()
    {
        $query = Auth::User()->alunos();

        if ($this->filterName) {
            $query->where('users.name', 'like', '%' . $this->filterName . '%');
        }

        if ($this->filterTelefone) {
            $query->where('users.telefone', 'like', '%' . $this->filterTelefone . '%');
        }

        $users = $query->paginate(5);

        return view('livewire.table-students-guard', ['users' => $users]);
    }

    public function deleteUser($id)
    {
        $guard = Auth::user();

        if (!$guard->alunos()->where('users.id', $id)->exists()) {
            session()->flash('error', 'Ação não autorizada!');
            return;
        }

        $guard->alunos()->detach($id);

        $user = User::find($id);

        if (auth()->id() == $id) {
            session()->flash('error', 'Ação Não Autorizada!');
            return;
        }

        if ($user) {
            $user->delete();
            session()->flash('success', 'Usuário excluído com sucesso!');
        }
    }

    public function editUser($id)
    {
        $user = Auth::user()->alunos()->find($id);

        if (!$user) {
            session()->flash('error', 'Ação não autorizada!');
            return;
        }

        $this->editUserId = $user->id;
        $this->editName = $user->name;
        $this->editTelefone = $user->telefone;

        $this->dispatch('showEditModal');
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
            ]);

            session()->flash('success', 'Usuário atualizado com sucesso!');

            $this->reset(['editUserId', 'editName', 'editTelefone']);
            $this->dispatch('hideEditModal');
        }

        return redirect()->route('painel.usuarios')->with('success', 'Usuário atualizado com sucesso!');
    }
}
