<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Produto;

class TableStock extends Component
{
    use WithPagination;
    public $filterType;
    public $filterName;
    public $name;
    public $describe;
    public $price;
    public $type;
    public $amount;
    
    public function mount(){
        $this->filterType = null;
        $this->filterName = null;
        $this->name = null;
        $this->describe = null;
        $this->price = null;
        $this->type = null;
        $this->amount = null;
    }

    public function render()
    {
        $query = Produto::query();
        if($this->filterType){
            $query->where('type',$this->filterType);
        }

        if($this->filterName){
            $query->where('name','like',"%" . $this->filterName . "%");
        }

        $products = $query->paginate(10);
        return view('livewire.table-stock',['products'=>$products]);
    }

    public function storeProduct(){
        $this->validate([
            'name' => 'required|unique:products,name',
            'describe' => 'required|max:255',
            'price' => 'required',
            'type' => 'required',
            'amount' => 'required'
        ],[
            'name.required' => 'É Necessário Informar um Nome',
            'name.unique' => 'Produto Já Cadastrado',
            'describe.required' => 'É Necessário Informar uma Descrição',
            'describe.max' => 'Máximo de 255 caracteres',
            'price.required' => 'É Necessário Informar um Preço',
            'type.required' => 'É Necessário Selecionar um Tipo',
            'amount.required' => 'É Necessário Informar a Quantidade'
        ]);

        Produto::create([
            'name' => $this->name,
            'describe' => $this->describe,
            'price' => $this->price,
            'type' => $this->type,
            'amount' => $this->amount
        ]);

        $this->reset();
        $this->dispatch("closeModal");
    }

    public function darDD(){
        dd("Funfando");
    }
}
