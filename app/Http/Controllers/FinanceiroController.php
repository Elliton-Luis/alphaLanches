<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Cart;
use App\Models\SaleProduct;
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

        // Ranking de produtos mais vendidos
        $ranking = SaleProduct::with('product')
            ->select('product_id', DB::raw('SUM(productQuantity) as quantity'))
            ->groupBy('product_id')
            ->orderByDesc('quantity')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->product->name,
                    'quantity' => $item->quantity,
                ];
            });

        $totalQuantity = $ranking->sum('quantity');
        $ranking->transform(function ($item) use ($totalQuantity) {
            $item['percentage'] = $totalQuantity > 0
                ? round($item['quantity'] / $totalQuantity * 100)
                : 0;
            return $item;
        });

        // Receita agrupada por mês
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

        for ($i = 5; $i >= 0; $i--) {
            $date = $referenceDate->copy()->subMonths($i);
            $key = $date->month . '-' . $date->year;

            $months[] = ucfirst($date->translatedFormat('F Y'));
            $revenues[] = $monthlyRevenue[$key]->total ?? 0;
        }

        // ✅ Total de itens vendidos (somatório geral)
        $totalItemsSold = Cart::sum('total');

        return view('financeiro', compact(
            'totalSalesValue',
            'dailySales',
            'monthlySales',
            'totalDailyValue',
            'totalMonthlyValue',
            'ranking',
            'months',
            'revenues',
            'totalItemsSold'
        ));
    }
}
