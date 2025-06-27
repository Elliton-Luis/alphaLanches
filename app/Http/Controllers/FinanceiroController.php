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
        // 📦 Todas as vendas
        $sales = Sale::with(['user', 'saleProducts.product'])->orderByDesc('saleDate')->get();

        // 📊 Totais usando Carts
        $totalSalesValue = Cart::where('status', 'completed')->sum('total');

        $today = Carbon::today();
        $totalDailyValue = Cart::where('status', 'completed')
                                ->whereDate('created_at', $today)
                                ->sum('total');
        $dailySales = Sale::whereDate('saleDate', $today)->count();

        $now = now();
        $totalMonthlyValue = Cart::where('status', 'completed')
                                ->whereMonth('created_at', $now->month)
                                ->whereYear('created_at', $now->year)
                                ->sum('total');
        $monthlySales = Sale::whereMonth('saleDate', $now->month)
                            ->whereYear('saleDate', $now->year)
                            ->count();

        // 🥇 Ranking de produtos mais vendidos
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
            $item['percentage'] = $totalQuantity > 0 ? round($item['quantity'] / $totalQuantity * 100) : 0;
            return $item;
        });

        // 📈 Receita dos últimos 6 meses via Carts
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

        $months = [];
        $revenues = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $key = $date->month . '-' . $date->year;
            $months[] = $date->format('M');
            $revenues[] = $monthlyRevenue[$key]->total ?? 0;
        }

        return view('financeiro', compact(
            'sales',
            'totalSalesValue',
            'dailySales',
            'monthlySales',
            'totalDailyValue',
            'totalMonthlyValue',
            'ranking',
            'months',
            'revenues'
        ));
    }
}
