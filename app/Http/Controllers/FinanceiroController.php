<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleProduct;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 

class FinanceiroController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['user', 'saleProducts.product'])->orderByDesc('saleDate')->get();

        // 🔁 Função para calcular valor total de uma venda
        $calcTotal = function ($sales) {
            return $sales->sum(function ($sale) {
                return $sale->saleProducts->sum(function ($product) {
                    return $product->productQuantity * $product->product->price;
                });
            });
        };

        // 🔢 Totais gerais
        $totalSalesValue = $calcTotal($sales);

        // 📅 Hoje
        $today = Carbon::today()->toDateString();
        $dailySalesQuery = Sale::whereDate('saleDate', $today)->with('saleProducts.product')->get();
        $dailySales = $dailySalesQuery->count();
        $totalDailyValue = $calcTotal($dailySalesQuery);

        // 📆 Mês atual
        $now = now();
        $monthlySalesQuery = Sale::whereMonth('saleDate', $now->month)
                                ->whereYear('saleDate', $now->year)
                                ->with('saleProducts.product')
                                ->get();
        $monthlySales = $monthlySalesQuery->count();
        $totalMonthlyValue = $calcTotal($monthlySalesQuery);

        // 📦 Ranking de produtos mais vendidos
        $products = SaleProduct::with('product')->get();
        $grouped = $products->groupBy('product_id')->map(function ($items) {
            return [
                'name' => $items->first()->product->name,
                'quantity' => $items->sum('productQuantity'),
            ];
        });

        $totalQuantity = $grouped->sum('quantity');
        $ranking = $grouped->map(function ($item) use ($totalQuantity) {
            $item['percentage'] = $totalQuantity > 0 ? round($item['quantity'] / $totalQuantity * 100) : 0;
            return $item;
        })->sortByDesc('quantity')->values();

        // 📊 Gráfico de receita por mês (últimos 6 meses)
        $monthlyRevenueRaw = Sale::select(
                DB::raw('MONTH(saleDate) as month'),
                DB::raw('YEAR(saleDate) as year'),
                DB::raw('SUM(sale_products.productQuantity * products.price) as total')
            )
            ->join('sale_products', 'sales.id', '=', 'sale_products.sale_id')
            ->join('products', 'sale_products.product_id', '=', 'products.id')
            ->where('saleDate', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy(DB::raw('YEAR(saleDate)'), DB::raw('MONTH(saleDate)'))
            ->orderBy(DB::raw('YEAR(saleDate)'))
            ->orderBy(DB::raw('MONTH(saleDate)'))
            ->get()
            ->keyBy(function ($item) {
                return $item->month . '-' . $item->year;
            });

        $months = [];
        $revenues = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthKey = $date->month . '-' . $date->year;
            $months[] = $date->format('M'); // Jan, Fev, Mar...
            $revenues[] = isset($monthlyRevenueRaw[$monthKey]) ? round($monthlyRevenueRaw[$monthKey]->total, 2) : 0;
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
