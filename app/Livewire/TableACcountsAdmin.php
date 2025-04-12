<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\User;

class TableACcountsAdmin extends Component
{

    use WithPagination;

    protected $listeners = ['storeAccount'=>'render'];

    public $name;
    public $telefone;
    public $type;

    public function mount()
    {
        $this->name = null;
        $this->telefone = null;
        $this->type = null;
    }

    public function render()
    {
        $query = User::query();

        if($this->name){
            $query->where('name','like','%'.$this->name.'%');
        }

        if($this->telefone){
            $query->where('telefone','like','%'.$this->name.'%');
        }

        if($this->type){
            $query->where('type',$this->type);
        }

        $users = $query->paginate(5);

        return view('livewire.table-a-ccounts-admin', ['users'=>$users]);
    }

    public function deleteUser($id){
        $user = User::find($id);
        if($id == auth()->user()->id){
            return session()->flash('error','Não é possível deletar a sí mesmo');
        }
        $user->delete();
    }

}
