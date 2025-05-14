<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Sale;
use App\Models\SaleProduct;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PDVController extends Controller
{
    public function index()
    {
        $products = Produto::all();
        $todayTotal = Sale::whereDate('saleDate', today())->sum('value');
        return view('pdv', compact('products', 'todayTotal'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'items_json' => 'required|string',
            'payment_method' => 'required|in:dinheiro,credit,cartao,pix',
        ]);

        $items = json_decode($request->items_json, true);
        $total = 0;

        foreach ($items as $item) {
            $product = Produto::find($item['product_id']);
            if (!$product || $product->amount < $item['quantity']) {
                return redirect()->route('pdv.index')->with('errorAuth', "Estoque insuficiente para o produto {$product->name}.");
            }
            $total += $product->price * $item['quantity'];
        }

        $sale = Sale::create([
            'customer_id' => $user->id,
            'saleDate' => now(),
            'value' => $total,
            'payment_method' => $request->payment_method,
        ]);

        foreach ($items as $item) {
            $product = Produto::find($item['product_id']);
            $product->amount -= $item['quantity'];
            $product->save();

            SaleProduct::create([
                'sale_id' => $sale->id,
                'product_id' => $item['product_id'],
                'productQuantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('pdv.index')->with('success', 'Venda realizada com sucesso!');
    }

    public function reporEstoque(Request $request)
    {
        $product = Produto::find($request->product_id);
        $product->amount += $request->amount;
        $product->save();

        return redirect()->route('pdv.index')->with('success', 'Estoque atualizado com sucesso!');
    }
}
