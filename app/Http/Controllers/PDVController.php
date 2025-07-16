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
        return view('pdv', compact('products'));
    }

    public function reporEstoque(Request $request)
    {
        $product = Produto::find($request->product_id);
        $product->amount += $request->amount;
        $product->save();

        return redirect()->route('pdv.index')->with('success', 'Estoque atualizado com sucesso!');
    }
}
