<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RecargaController extends Controller
{
    public function index()
    {
        return view('recarga');
    }

    public function process(Request $request)
    {
        $request->validate([
            'valor' => 'required|numeric|min:0.01',
            'metodo' => 'required|string'
        ]);

        $user = Auth::user();
        $valor = floatval($request->valor);

        // Atualizar saldo do usuário
        $user->credit += $valor;
        $user->save();

        return response()->json([
            'sucesso' => true,
            'novo_saldo' => $user->credit
        ]);
    }
}
