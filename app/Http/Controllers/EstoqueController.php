<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class EstoqueController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');

        if ($type) {
            $products = Produto::where('type', $type)->get();
        } else {
            $products = Produto::all();
        }

        return view('estoque', compact('products', 'type'));
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'describe' => 'nullable|string',
            'price' => 'required|numeric',
            'type' => 'required|string',
            'amount' => 'required|integer',
        ]);

        // Criar o produto
        $product = Produto::create([
            'name' => $validated['name'],
            'describe' => $validated['describe'],
            'price' => $validated['price'],
            'type' => $validated['type'],
            'amount' => $validated['amount'],
        ]);

        return response()->json(['message' => 'Produto adicionado com sucesso!', 'product' => $product]);
    }

    public function updateStock(Request $request, $id)
    {
        $product = Produto::findOrFail($id);
        $product->amount += $request->change;
        $product->save();
        return response()->json(['amount' => $product->amount]);
    }

    public function updateValue(Request $request, $id)
    {
        $product = Produto::findOrFail($id);
        $product->price = $request->price;
        $product->save();
    }
}