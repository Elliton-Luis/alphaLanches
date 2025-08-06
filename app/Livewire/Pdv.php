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
    public $paymentMethod;

    public function mount()
    {
        $this->filterName = null;
        $this->quantity = 1;
        $this->total = 0;

        $this->cart = Cart::where('user_id', auth()->id())->where('status', 'open')->first();

        if ($this->cart) {
            $items = CartItem::where('cart_id', $this->cart->id)->get();

            foreach ($items as $item) {
                $this->total += $item->product->price * $item->quantity;
            }
        }

        $this->paymentMethod = null;

    }

    public function render()
    {

        $query = Produto::query();

        if ($this->filterName) {
            $query->where('name', 'like', '%' . $this->filterName . '%');
            $this->resetPage();
        }

        $products = $query->paginate(6);

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

    public function checkCart()
    {

        if (!$this->cart) {
            $this->cart = Cart::create([
                'user_id' => auth()->user()->id,
            ]);
        }
        return $this->cart;
    }

    public function fillCart($id)
    {
        $this->cart = $this->checkCart();

        $stock = Produto::find($id);

        if (!$stock || $stock->amount <= 0) {
            session()->flash('error', 'Produto indisponível no estoque');
            return;
        }

        $cartItem = CartItem::where('cart_id', $this->cart->id)
            ->where('product_id', $id)
            ->first();

        if (!$cartItem) {
            $produto = Produto::findOrFail($id);

            CartItem::create([
                'cart_id' => $this->cart->id,
                'product_id' => $id,
                'quantity' => 1,
                'unit_price' => $produto->price,
            ]);


            $this->total += $stock->price;
            return;
        }

        if ($cartItem->quantity >= $stock->amount) {
            session()->flash('error', 'Quantidade indisponível no estoque');
            return;
        }

        $cartItem->increment('quantity');
        $this->total += $stock->price;
    }


    public function emptyCart()
    {

        if ($this->total > 0 && $this->paymentMethod) {
            $cartItems = CartItem::where('cart_id', $this->cart->id)->get();
            $ids = $cartItems->pluck('product_id');
            $stock = Produto::whereIn('id', $ids)->get();

            foreach ($cartItems as $cartItem) {
                $product = $stock->firstWhere('id', $cartItem->product_id);
                if ($product) {
                    $product->amount -= $cartItem->quantity;
                    $product->save();
                }
            }

            $this->cart->status = 'completed';
            $this->cart->paymentMethod = $this->paymentMethod;
            $this->cart->total = $this->total;
            $this->cart->save();
            $this->reset();

            session()->flash('success', 'Compra Feita Com Sucesso!!');
        } else {
            if ($this->total <= 0) {
                session()->flash('error', 'O Carrinho Está Vazio!!');
            } else if ($this->paymentMethod == null) {
                session()->flash('error', 'Selecione um metodo de pagamento!!');
            }
        }
    }

    public function removeItem($id)
    {
        $cartItem = CartItem::where('cart_id', $this->cart->id)->where('product_id', $id)->first();
        $price = Produto::where('id', $id)->value('price');

        if ($cartItem->quantity > 0) {
            $cartItem->decrement('quantity');
            $this->total -= $price;
        }

        if ($cartItem->quantity == 0) {
            $cartItem->delete();
        }
    }
}
