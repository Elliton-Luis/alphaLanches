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
}