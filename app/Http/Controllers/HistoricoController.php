<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HistoricoController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::with(['user', 'saleProducts.product'])
            ->orderBy('saleDate', 'desc');

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

        if ($request->filled('cliente') && Auth::user()->isAdmin()) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->cliente . '%');
            });
        }

        if ($request->filled('produto')) {
            $query->whereHas('saleProducts.product', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->produto . '%');
            });
        }

        $vendas = $query->paginate(10);

        return view('historico.index', compact('vendas'));
    }

    public function show($id)
    {
        $venda = Sale::with(['user', 'saleProducts.product'])
            ->findOrFail($id);

        // Verifica se o usuário pode ver esta venda
        if (!Auth::user()->isAdmin() && $venda->customer_id !== Auth::id()) {
            abort(403, 'Acesso negado');
        }

        return view('historico.show', compact('venda'));
    }

    public function relatorio(Request $request)
    {
        // Apenas admin pode ver relatórios
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Acesso negado');
        }

        $dataInicio = $request->data_inicio ?? Carbon::now()->startOfMonth();
        $dataFim = $request->data_fim ?? Carbon::now()->endOfMonth();

        // Vendas no período
        $vendas = Sale::whereBetween('saleDate', [$dataInicio, $dataFim])
            ->with(['user', 'saleProducts.product'])
            ->get();

        // Estatísticas
        $totalVendas = $vendas->count();
        $valorTotal = $vendas->sum('value');
        $ticketMedio = $totalVendas > 0 ? $valorTotal / $totalVendas : 0;

        // Produtos mais vendidos
        $produtosMaisVendidos = $vendas->flatMap(function($venda) {
            return $venda->saleProducts;
        })->groupBy('product_id')->map(function($items) {
            return [
                'produto' => $items->first()->product->name,
                'quantidade' => $items->sum('productQuantity'),
                'valor_total' => $items->sum(function($item) {
                    return $item->productQuantity * $item->product->price;
                })
            ];
        })->sortByDesc('quantidade')->take(10);

        // Vendas por dia
        $vendasPorDia = $vendas->groupBy(function($venda) {
            return Carbon::parse($venda->saleDate)->format('Y-m-d');
        })->map(function($vendas) {
            return [
                'quantidade' => $vendas->count(),
                'valor' => $vendas->sum('value')
            ];
        });

        return view('historico.relatorio', compact(
            'vendas', 'totalVendas', 'valorTotal', 'ticketMedio',
            'produtosMaisVendidos', 'vendasPorDia', 'dataInicio', 'dataFim'
        ));
    }

    public function meuHistorico()
    {
        $vendas = Sale::with(['saleProducts.product'])
            ->where('customer_id', Auth::id())
            ->orderBy('saleDate', 'desc')
            ->paginate(10);

        return view('historico.meu-historico', compact('vendas'));
    }
}
