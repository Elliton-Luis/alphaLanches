<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        ->keyBy(fn ($item) => $item->month . '-' . $item->year);

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
        'paymentMethods'
    ));
    }
}
