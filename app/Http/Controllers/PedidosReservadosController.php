<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\ReservedProduct;

class PedidosReservadosController extends Controller
{
    // Exibe os pedidos em espera
    public function index()
    {
        $reservas = Sale::where('status', 'em espera')->orderBy('scheduled_date')->get();
        return view('pedidosReservados', compact('reservas'));
    }

    // Dá baixa no pedido
    public function concluir($id)
    {
        $reserva = Sale::findOrFail($id);

        $reserva->status = 'concluido';
        $reserva->save();

        // Remove os produtos reservados (opcional)
        ReservedProduct::where('sale_id', $reserva->id)->delete();

        return redirect()->route('pedidosReservados.index')->with('success', 'Baixa realizada com sucesso.');
    }
}