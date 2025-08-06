<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use App\Models\ReservedProduct;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
    public function index()
    {
        $pedidosEspera = Cart::with('cartItems.product')
            ->where('user_id', auth()->id())
            ->where('status', 'open')
            ->orderBy('scheduled_date', 'desc')
            ->get();

        $pedidosCancelados = Cart::with('cartItems.product')
            ->where('user_id', auth()->id())
            ->where('status', 'cancelado')
            ->orderBy('scheduled_date', 'desc')
            ->get();

        $pedidosConcluidos = Cart::with('cartItems.product')
            ->where('user_id', auth()->id())
            ->where('status', 'completed')
            ->orderBy('scheduled_date', 'desc')
            ->get();

        $products = Produto::all();

        $reservados = ReservedProduct::selectRaw('product_id, SUM(quantity) as total_reserved')
            ->groupBy('product_id')
            ->pluck('total_reserved', 'product_id');

        foreach ($products as $product) {
            $reservedQty = $reservados[$product->id] ?? 0;
            $product->available = $product->amount - $reservedQty;
        }

        $todayTotal = Cart::whereDate('created_at', today())->sum('total');

        return view('agendamento', compact(
            'products',
            'todayTotal',
            'pedidosEspera',
            'pedidosCancelados',
            'pedidosConcluidos'
        ));
    }

    public function store(Request $request)
    {
        $request->merge(['user_id' => auth()->id()]);

        $request->validate([
            'user_id' => 'required|exists:users,id',
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

        if ($request->payment_method === 'credit') {
            $customer = User::find($request->user_id);
            if ($customer->credit < $total) {
                return redirect()->route('agendamento.index')->with('errorAuth', 'Créditos insuficientes para esta venda.');
            }
            $customer->credit -= $total;
            $customer->save();
        }

        $cart = Cart::create([
            'user_id' => $request->user_id,
            'scheduled_date' => $request->scheduled_date,
            'total' => $total,
            'paymentMethod' => $request->payment_method,
            'status' => 'open',
        ]);

        foreach ($items as $item) {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
            ]);

            $user = auth()->user();

            // Verificação: se for responsável e não enviou student_id, retorna erro
            if ($user->type === 'responsible' && !$request->filled('student_id')) {
                return back()->withErrors('Você precisa selecionar um estudante para o pedido.');
            }

            // Criação do ReservedProduct
            ReservedProduct::create([
                'sale_id' => $cart->id,
                'product_id' => $item['product_id'],
                'customer_id' => $user->id,
                'student_id' => $user->type === 'student' ? $user->id : $request->student_id,
                'quantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('agendamento.index')->with('success', 'Venda agendada com sucesso!');
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
        $pedido = Cart::findOrFail($id);

        if ($pedido->user_id !== auth()->id()) {
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