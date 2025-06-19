<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\Produto;

class ModalEdit extends Component
{
    public $id;
    public $name;
    public $describe;
    public $price;
    public $amount;
    public $type;

    #[On('alteredProduct')]
    public function mount()
    {
        $product = Produto::find($this->id);

        $this->name = $product->name;
        $this->describe = $product->describe;
        $this->price = $product->price;
        $this->amount = $product->amount;
        $this->type = $product->type;
    }

    public function render()
    {
        return view('livewire.modal-edit');
    }


    public function alterProduct()
    {
        $product = Produto::find($this->id);

        if($this->name != $product->name){
            $product->name = $this->name;
        }
        if($this->describe != $product->describe){
            $product->describe = $this->describe;
        }
        if($this->price != $product->price){
            $product->price = $this->price;
        }
        if($this->amount != $product->amount){
            $product->amount = $this->amount;
        }
        if($this->type != $product->type){
            $product->type = $this->type;
        }

        $product->save();
        session()->flash('success','Produto alterado com sucesso');
        $this->dispatch('alteredProduct');
    }
}
