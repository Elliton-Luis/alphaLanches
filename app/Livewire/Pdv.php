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
    public $quantity;
    public $total;

    public function mount(){
        $this->filterName = null;
        $this->quantity = 1;
        $this->total = 0;
    }

    public function render()
    {
        $query = Produto::query();

        if($this->filterName){
            $query->where('name','like','%'.$this->filterName.'%');
        }

        $products = $query->paginate(6);

        $cartItems = CartItem::all();

        return view('livewire.pdv', [
            'products' => $products,
            'cartItems' => $cartItems,
            'total' => $this->total
        ]);
    }

    public function fillCart($id)
    {
        $product = Produto::find($id);

        $cartItem = CartItem::where('name', $product->name)->first();

    if ($cartItem) {

        $cartItem->quantity++;
        $cartItem->save();
    } else {
        CartItem::create([
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1
        ]);
        }
    }

    public function emptyCart(){
        CartItem::truncate();
    }
}
