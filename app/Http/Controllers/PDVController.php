<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Sale;
use App\Models\SaleProduct;

class PDVController extends Controller
{
    public function index()
    {
        $products = Produto::all();
        return view('pdv', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'items' => 'required|array',
        ]);

        $total = 0;
        foreach ($request->items as $item) {
            $product = Produto::find($item['product_id']);
            $total += $product->price * $item['quantity'];
        }

        $sale = Sale::create([
            'customer_id' => $request->customer_id,
            'saleDate' => now(),
            'value' => $total,
        ]);

        foreach ($request->items as $item) {
            SaleProduct::create([
                'sale_id' => $sale->id,
                'product_id' => $item['product_id'],
                'productQuantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('pdv.index')->with('success', 'Venda realizada com sucesso!');
    }
}
