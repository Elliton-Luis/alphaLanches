<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class EstoqueController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('estoque.index', compact('produtos'));
    }

    public function updateStock(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->quantidade += $request->change;
        $produto->save();
        return response()->json(['quantidade' => $produto->quantidade]);
    }

    public function updateValue(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->valor = $request->valor;
        $produto->save();
    }
}