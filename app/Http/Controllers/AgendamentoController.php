<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Sale;
use App\Models\SaleProduct;
use App\Models\User;

class AgendamentoController extends Controller
{
    public function index()
    {
        $reservas = Sale::where('customer_id', auth()->id())
            ->orderBy('scheduled_date', 'desc')
            ->get();
        $products = Produto::all();
        $todayTotal = Sale::whereDate('saleDate', today())->sum('value');
        return view('agendamento', compact('products', 'todayTotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'items_json' => 'required|string',
            'payment_method' => 'required|in:dinheiro,credit,cartao,pix',
            'scheduled_date' => 'required|date|after_or_equal:today',
        ]);        

        $items = json_decode($request->items_json, true);
        $total = 0;

        foreach ($items as $item) {
            $product = Produto::find($item['product_id']);
            if (!$product || $product->amount < $item['quantity']) {
                return redirect()->route('agendamento.index')->with('errorAuth', "Estoque insuficiente para o produto {$product->name}.");
            }
            $total += $product->price * $item['quantity'];
        }

        if ($request->payment_method == 'credit') {
            $customer = User::find($request->customer_id);
            if ($customer->credit < $total) {
                return redirect()->route('agendamento.index')->with('errorAuth', 'Créditos insuficientes para esta venda.');
            }
            $customer->credit -= $total;
            $customer->save();
        }

        $sale = Sale::create([
            'customer_id' => $request->customer_id,
            'saleDate' => now(),
            'scheduled_date' => $request->scheduled_date,
            'value' => $total,
            'payment_method' => $request->payment_method,
            'status' => 'em espera', // campo status deve existir
        ]);

        foreach ($items as $item) {
            $product = Produto::find($item['product_id']);
            $product->amount -= $item['quantity'];
            $product->save();

            SaleProduct::create([
                'sale_id' => $sale->id,
                'product_id' => $item['product_id'],
                'productQuantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('agendamento.index')->with('success', 'Venda realizada com sucesso!');
    }

    public function searchUser(Request $request)
    {
        $search = $request->get('query');
        $customers = User::where('name', 'LIKE', "%{$search}%")->limit(10)->get(['id', 'name']);
        return response()->json($customers);
    }
}
