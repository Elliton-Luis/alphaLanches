<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produto;
use Livewire\WithPagination;
use App\Models\CartItem;
use App\Models\Cart;

class Pdv extends Component
{
    use WithPagination;

    public $filterName;
    public $quantity;
    public $total;
    public $cart;

    public function mount(){
        $this->filterName = null;
        $this->quantity = 1;
        $this->total = 0;
        $this->cart = [];
        $this->cartItems = [];
        $this->quantities = [];
        $this->items = [];
    }

    public function render()
    {

        $query = Produto::query();

        if($this->filterName){
            $query->where('name','like','%'.$this->filterName.'%');
            $this->resetPage();
        }

        $products = $query->paginate(6);

        $this->cart = Cart::where('user_id',auth()->id())->where('status','open')->first();

        $this->checkCart();

        $cartItems = CartItem::where('cart_id', $this->cart->id)->get();

        $productIds = $cartItems->pluck('product_id');
            
        $items = Produto::whereIn('id', $productIds)->get();

        $quantities = CartItem::where('cart_id', $this->cart->id)->pluck('quantity', 'product_id');
        
        return view('livewire.pdv', [
            'products' => $products,
            'items' => $items,
            'quantities' => $quantities,
            'total' => $this->total
        ]);
    }

    public function checkCart(){
        
        if(!$this->cart){
            $this->cart = Cart::create([
            'user_id' => auth()->user()->id,
            ]);
        }
        return $this->cart;
    }
    
    public function fillCart($id)
    {
        $this->cart = $this->checkCart();

        $cartItem = CartItem::where('cart_id',$this->cart->id)->where('product_id', $id)->first();

        if(!$cartItem){
            CartItem::create([
            'cart_id' => $this->cart->id,
            'product_id' => $id,
            ]);

        return ;
        }
        $stock = Produto::where('id',$id)->first();

        if($cartItem->quantity >= $stock->amount){
            session()->flash('error','Quantidade Indisponível no Estoque');
            return ;
        }
        $cartItem->increment('quantity');

    }

    public function emptyCart($total){

        if($total > 0){
            $this->cart->status = 'completed';
            $this->cart->total = $total;
            $this->cart->save();

            return session()->flash('success','Compra Feita Com Sucesso!!');
        }
        return session()->flash('error','O Carrinho Está Vazio!!');

    }

    public function removeItem($id){
        $cartItem = CartItem::where('cart_id',$this->cart->id)->where('product_id', $id)->first();

        if($cartItem->quantity > 0){
            $cartItem->decrement('quantity');
        }
        
        if($cartItem->quantity == 0){
            $cartItem->delete();
        }
    }
}
