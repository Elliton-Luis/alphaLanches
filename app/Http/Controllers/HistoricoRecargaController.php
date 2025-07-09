<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditLog;
use Illuminate\Support\Facades\Auth;

class HistoricoRecargaController extends Controller
{
    public function index(Request $request)
    {
        $query = CreditLog::with(['user', 'executor'])
            ->orderBy('created_at', 'desc');

        // Se não for admin, mostra apenas compras do usuário logado
        if (!Auth::user()->isAdmin()) {
            $query->where('customer_id', Auth::id());
        }

        // Filtros
        if ($request->filled('data_inicio')) {
            $query->where('saleDate', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->where('saleDate', '<=', $request->data_fim);
        }

        if ($request->filled('produto')) {
            $query->whereHas('saleProducts.product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->produto . '%');
            });
        }

        $vendas = $query->paginate(10);

        return view('historico.index', compact('vendas'));
    }
}
