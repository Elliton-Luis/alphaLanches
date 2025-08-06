<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produto;
use App\Models\ReservedProduct;
use Illuminate\Support\Facades\DB;

class PedidosReservadosController extends Controller
{
    // Exibe os pedidos em espera
    public function index()
    {
        $reservas = Cart::with(['user', 'reservedProducts.product'])
            ->where('status', 'open')
            ->orderBy('scheduled_date')
            ->get();

        return view('pedidosReservados', compact('reservas'));
    }

    // Dá baixa no pedido
    public function concluir($id)
    {
        DB::transaction(function () use ($id) {
            $reserva = Cart::findOrFail($id);

            // Atualiza o status do carrinho
            $reserva->status = 'completed';
            $reserva->save();

            // Atualiza o estoque dos produtos reservados
            $reservedProducts = ReservedProduct::where('cart_id', $reserva->id)->get();

            foreach ($reservedProducts as $reserved) {
                $product = Produto::find($reserved->product_id);
                $product->amount -= $reserved->quantity;
                $product->save();
            }

            // Remove os produtos reservados (pois já deram baixa)
            ReservedProduct::where('cart_id', $reserva->id)->delete();
        });

        return redirect()->route('pedidosReservados.index')->with('success', 'Baixa realizada com sucesso.');
    }
}