<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Sale;
use App\Models\SaleProduct;
use App\Models\User;

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
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'items_json' => 'required|string',
            'payment_method' => 'required|in:dinheiro,creditos,cartao,pix',
        ]);

        $items = json_decode($request->items_json, true);

        $total = 0;
        foreach ($items as $item) {
            $product = Produto::find($item['product_id']);
            $total += $product->price * $item['quantity'];
        }

        $sale = Sale::create([
            'customer_id' => $request->customer_id,
            'saleDate' => now(),
            'value' => $total,
            'payment_method' => $request->payment_method,
        ]);

        foreach ($items as $item) {
            SaleProduct::create([
                'sale_id' => $sale->id,
                'product_id' => $item['product_id'],
                'productQuantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('pdv.index')->with('success', 'Venda realizada com sucesso!');
    }


    public function searchUser(Request $request)
    {
        $search = $request->get('query');
        $customers = User::where('name', 'LIKE', "%{$search}%")->limit(10)->get(['id', 'name']);
        return response()->json($customers);
    }
}
