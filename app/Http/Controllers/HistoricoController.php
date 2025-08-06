<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HistoricoController extends Controller
{
    public function index(Request $request)
    {
        $query = Cart::with(['user', 'items.product'])
            ->orderBy('created_at', 'desc');

        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }

        if ($request->filled('data_inicio')) {
            $query->where('created_at', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->where('created_at', '<=', $request->data_fim);
        }

        if ($request->filled('produto')) {
            $query->whereHas('items.product', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->produto . '%'); // name do produto no modelo Produto
            });
        }

        $vendas = $query->paginate(10);

        return view('historico.index', compact('vendas'));
    }

    public function show($id)
    {
        $venda = Cart::with(['user', 'items.product'])->findOrFail($id);

        if (!Auth::user()->isAdmin() && $venda->user_id !== Auth::id()) {
            abort(403, 'Acesso negado');
        }

        return view('historico.show', compact('venda'));
    }

    public function meuHistorico()
    {
        $vendas = Cart::with(['items.product'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('historico.meu-historico', compact('vendas'));
    }
}