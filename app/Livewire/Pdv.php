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

        $cart = Cart::where('user_id',auth()->id())->where('status','open')->first();

        $cartItems = [];

        $quantities = [];

        $items = [];

        if ($cart) {
            $cartItems = CartItem::where('cart_id', $cart->id)->get();

            $productIds = $cartItems->pluck('product_id');
            
            $items = Produto::whereIn('id', $productIds)->get();

            $quantities = CartItem::where('cart_id', $cart->id)->pluck('quantity', 'product_id');
        }
        
        return view('livewire.pdv', [
            'products' => $products,
            'items' => $items,
            'quantities' => $quantities,
            'total' => $this->total
        ]);
    }

    public function checkCart(){
        $cart = Cart::where('user_id',auth()->id())->where('status','open')->first();
        
        if(!$cart){
            $cart = Cart::create([
            'user_id' => auth()->user()->id,
            ]);
        }
        return $cart;
    }
    public function fillCart($id)
    {
        $cart = $this->checkCart();

        $cartItem = CartItem::where('cart_id',$cart->id)->where('product_id', $id)->first();;

        if(!$cartItem){
            CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $id,
        ]);

        } else {
             $cartItem->increment('quantity');
            }

        }

    public function emptyCart(){

        $cart = Cart::where('user_id',auth()->id())->where('status','open')->first();
        $cart->status = 'completed';
        $cart->save();

    }
}
