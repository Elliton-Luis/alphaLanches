<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
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
        $products = $this->getProducts();
        return view('livewire.table-stock',['products'=>$products]);
    }

    #[On('alteredProduct')]
    public function getProducts()
    {
        $query = Produto::query();
        if($this->filterType){
            $query->where('type',$this->filterType);
        }

        if($this->filterName){
            $query->where('name','like',"%" . $this->filterName . "%");
        }

        return $query->paginate(10);
    }

    public function storeProduct(){
        $this->validate([
            'name' => 'required|unique:products,name',
            'describe' => 'required|max:255',
            'price' => 'required|min:0|max:999',
            'type' => 'required',
            'amount' => 'required|integer|min:0|max:999'
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

    public function addProduct($id){
        $product = Produto::find($id);
        $product->amount+=1;
        $product->save();
        $this->dispatch('alteredProduct');
    }

    public function reduceProduct($id){
        $product = Produto::find($id);
        $product->amount-=1;
        $product->save();
        $this->dispatch('alteredProduct');
    }
}
