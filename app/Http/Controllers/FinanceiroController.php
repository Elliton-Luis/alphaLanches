<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class FinanceiroController extends Controller
{
    public function index()
    {
        Carbon::setLocale('pt_BR');

        // Total de vendas
        $totalSalesValue = Cart::where('status', 'completed')->sum('total');

        // Total e quantidade de vendas diárias
        $today = Carbon::today();
        $totalDailyValue = Cart::where('status', 'completed')
            ->whereDate('created_at', $today)
            ->sum('total');

        $dailySales = Cart::where('status', 'completed')
            ->whereDate('created_at', $today)
            ->count();

        // Ticket médio diário
        $averageDailyTicket = $dailySales > 0 ? $totalDailyValue / $dailySales : 0;

        // Total e quantidade de vendas mensais
        $now = now();
        $totalMonthlyValue = Cart::where('status', 'completed')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->sum('total');

        $monthlySales = Cart::where('status', 'completed')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        // Ticket médio mensal
        $averageMonthlyTicket = $monthlySales > 0 ? $totalMonthlyValue / $monthlySales : 0;

        // Receita agrupada por mês (últimos 6 meses)
        $monthlyRevenue = Cart::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('SUM(total) as total')
        )
            ->where('status', 'completed')
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->keyBy(fn($item) => $item->month . '-' . $item->year);

        $referenceDate = now()->startOfMonth();
        $months = [];
        $revenues = [];
        $accumulatedRevenue = 0;

        for ($i = 5; $i >= 0; $i--) {
            $date = $referenceDate->copy()->subMonths($i);
            $key = $date->month . '-' . $date->year;

            $value = $monthlyRevenue[$key]->total ?? 0;
            $months[] = ucfirst($date->translatedFormat('F Y'));
            $revenues[] = $value;
            $accumulatedRevenue += $value;
        }

        // Total de itens vendidos (somatório geral)
        $totalItemsSold = CartItem::sum('quantity');

        $ranking = CartItem::select('product_id', DB::raw('SUM(quantity) as total'))
            ->groupBy('product_id')
            ->with('product') // carrega o produto para evitar N+1
            ->orderByDesc('total')
            ->get()
            ->map(function ($item) use ($totalItemsSold) {
                return [
                    'name' => $item->product->name ?? 'Produto removido', // <-- CORRETO AGORA
                    'quantity' => $item->total,
                    'percentage' => $totalItemsSold > 0 ? round(($item->total / $totalItemsSold) * 100, 2) : 0,
                ];
            })->take(5);

        // Se houver forma de pagamento em Cart
        $paymentMethods = Cart::select('paymentMethod', DB::raw('SUM(total) as total'))
            ->where('status', 'completed')
            ->groupBy('paymentMethod')
            ->get();

        return view('financeiro', compact(
            'totalSalesValue',
            'dailySales',
            'monthlySales',
            'totalDailyValue',
            'totalMonthlyValue',
            'months',
            'revenues',
            'accumulatedRevenue',
            'totalItemsSold',
            'averageDailyTicket',
            'averageMonthlyTicket',
            'paymentMethods',
            'ranking'
        ));
    }

    public function exportarPDF()
    {
        $user = auth()->user();
        $inicio = Carbon::today()->subDays(6);
        $fim = Carbon::today()->endOfDay();

        // Buscando as vendas finalizadas no período
        $vendas = Cart::with('items.product')
            ->where('status', 'completed') // ajuste conforme seu sistema
            ->whereBetween('created_at', [$inicio, $fim])
            ->get();

        if ($vendas->isEmpty()) {
            return back()->with('error', 'Não há vendas nos últimos 7 dias para gerar o relatório.');
        }

        $totalVendas = 0;
        $formasPagamento = [];
        $produtosVendidos = [];

        foreach ($vendas as $venda) {
            $forma = $venda->paymentMethod ?? 'Desconhecida'; // ajuste se necessário
            $vendaTotal = 0;

            foreach ($venda->items as $item) {
                $quantidade = $item->quantity;
                $produto = $item->product;
                $preco = $produto->price;

                // Soma ao total geral
                $vendaTotal += $quantidade * $preco;

                if (!isset($produtosVendidos[$produto->id])) {
                    $produtosVendidos[$produto->id] = [
                        'nome' => $produto->name,
                        'quantidade' => 0,
                        'preco_unitario' => $preco,
                        'total' => 0,
                    ];
                }

                $produtosVendidos[$produto->id]['quantidade'] += $quantidade;
                $produtosVendidos[$produto->id]['total'] += $quantidade * $preco;
            }

            $totalVendas += $vendaTotal;

            // Agrupar por forma de pagamento
            if (!isset($formasPagamento[$forma])) {
                $formasPagamento[$forma] = 0;
            }
            $formasPagamento[$forma] += $vendaTotal;
        }

        $numVendas = $vendas->count();
        $ticketMedio = $numVendas > 0 ? $totalVendas / $numVendas : 0;

        // Processar formas de pagamento (percentual)
        $formasPagamentoFormatadas = collect($formasPagamento)->map(function ($valor) use ($totalVendas) {
            $percentual = $totalVendas > 0 ? ($valor / $totalVendas) * 100 : 0;
            return [
                'total' => $valor,
                'percentual' => $percentual,
            ];
        });

        $formaMaisUsada = collect($formasPagamento)->sortDesc()->keys()->first() ?? 'Nenhuma';

        $maisVendidos = collect($produtosVendidos)
            ->sortByDesc('quantidade')
            ->take(10);

        $produtoMaisVendido = $maisVendidos->first()['nome'] ?? 'Nenhum';

        $data = [
            'usuario' => $user->name,
            'inicio' => $inicio->format('d/m/Y'),
            'fim' => $fim->format('d/m/Y'),
            'totalVendas' => $totalVendas,
            'numVendas' => $numVendas,
            'ticketMedio' => $ticketMedio,
            'formaMaisUsada' => $formaMaisUsada,
            'produtoMaisVendido' => $produtoMaisVendido,
            'produtos' => $maisVendidos,
            'formasPagamento' => $formasPagamentoFormatadas,
        ];

        $pdf = Pdf::loadView('relatorios', $data);
        return $pdf->download('relatorio.pdf');
    }
}
