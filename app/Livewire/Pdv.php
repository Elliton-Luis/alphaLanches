<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produto;
use Livewire\WithPagination;
use App\Models\CartItem;

class Pdv extends Component
{
    use WithPagination;
    public $filterName;
    public $name;
    public $price;
    public $quantity;


    public function mount(){
        $this->filterName = null;
        $this->name = null;
        $this->price = null;
        $this->quantity = null;
    }

    public function render()
    {
        $query = Produto::query();

        if($this->filterName){
            $query->where('name','like','%'. $this->filterName . '%');
        }

        $products = $query->paginate(6);

        return view('livewire.pdv',['products'=>$products]);
    }

    public function fillCart($id){
        $product = Produto::find($id);
        
        CartItem::create([
            'name'=>
        ]);
    }
}
