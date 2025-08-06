<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Sale;
use App\Models\SaleProduct;
use App\Models\User;
use App\Models\ReservedProduct;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->type === 'student') {
            // Filtra vendas pelas reservas que têm o student_id correspondente
            $pedidosEspera = Sale::whereHas('reservedProducts', function ($query) use ($user) {
                    $query->where('student_id', $user->id);
                })
                ->with('saleProducts.product')
                ->where('status', 'em espera')
                ->orderBy('scheduled_date', 'desc')
                ->get();

            $pedidosCancelados = Sale::whereHas('reservedProducts', function ($query) use ($user) {
                    $query->where('student_id', $user->id);
                })
                ->with('saleProducts.product')
                ->where('status', 'cancelado')
                ->orderBy('scheduled_date', 'desc')
                ->get();

            $pedidosConcluidos = Sale::whereHas('reservedProducts', function ($query) use ($user) {
                    $query->where('student_id', $user->id);
                })
                ->with('saleProducts.product')
                ->where('status', 'concluído')
                ->orderBy('scheduled_date', 'desc')
                ->get();
        } else {
            // Continua usando o customer_id para responsáveis
            $pedidosEspera = Sale::with('saleProducts.product')
                ->where('customer_id', $user->id)
                ->where('status', 'em espera')
                ->orderBy('scheduled_date', 'desc')
                ->get();

            $pedidosCancelados = Sale::with('saleProducts.product')
                ->where('customer_id', $user->id)
                ->where('status', 'cancelado')
                ->orderBy('scheduled_date', 'desc')
                ->get();

            $pedidosConcluidos = Sale::with('saleProducts.product')
                ->where('customer_id', $user->id)
                ->where('status', 'concluído')
                ->orderBy('scheduled_date', 'desc')
                ->get();
        }

        $products = Produto::all();

        $reservados = ReservedProduct::selectRaw('product_id, SUM(quantity) as total_reserved')
            ->groupBy('product_id')
            ->pluck('total_reserved', 'product_id');

        foreach ($products as $product) {
            $reservedQty = $reservados[$product->id] ?? 0;
            $product->available = $product->amount - $reservedQty;
        }

        $todayTotal = Sale::whereDate('saleDate', today())->sum('value');
        
        $students = auth()->user()->alunos;

        return view('agendamento', compact('products', 'todayTotal', 'pedidosEspera', 'pedidosCancelados', 'pedidosConcluidos', 'students'));
    }

    public function store(Request $request)
    {
        $request->merge(['customer_id' => auth()->id()]);

        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'items_json' => 'required|string',
            'payment_method' => 'required|in:dinheiro,credit,cartao,pix',
            'student_id' => 'nullable|exists:users,id',
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
            //$product->amount -= $item['quantity'];
            $product->save();

            SaleProduct::create([
                'sale_id' => $sale->id,
                'product_id' => $item['product_id'],
                'productQuantity' => $item['quantity'],
            ]);

            $user = auth()->user();

            // Verificação: se for responsável e não enviou student_id, retorna erro
            if ($user->type === 'responsible' && !$request->filled('student_id')) {
                return back()->withErrors('Você precisa selecionar um estudante para o pedido.');
            }

            // Criação do ReservedProduct
            ReservedProduct::create([
                'sale_id' => $sale->id,
                'product_id' => $item['product_id'],
                'customer_id' => $user->id,
                'student_id' => $user->type === 'student' ? $user->id : $request->student_id,
                'quantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('agendamento.index')->with('success', 'Venda realizada com sucesso!');
    }

    public function pedidosEstudantes()
    {
        $user = auth()->user();

        if ($user->type !== 'guard') {
            return redirect()->route('agendamento.index')->with('errorAuth', 'Acesso negado.');
        }

        // Supondo que exista relação `students()` no model User
       $students = $user->alunos()->with(['reservedProducts.sale.saleProducts.product'])->get();

        return view('agendamento.estudantes', compact('students'));
    }

    public function cancelar($id)
    {
        $pedido = Sale::findOrFail($id);

        if ($pedido->customer_id !== auth()->id()) {
            return redirect()->route('agendamento.index')->with('errorAuth', 'Ação não autorizada.');
        }

        ReservedProduct::where('sale_id', $pedido->id)->delete();
        
        $pedido->status = 'cancelado';
        $pedido->save();

        return redirect()->route('agendamento.index')->with('success', 'Pedido cancelado com sucesso.');
    }

    public function searchUser(Request $request)
    {
        $search = $request->get('query');
        $customers = User::where('name', 'LIKE', "%{$search}%")->limit(10)->get(['id', 'name']);
        return response()->json($customers);
    }
}