<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RecargaController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('recarga', compact('users'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'valor' => 'required|numeric|min:0.01|max:999.99',
            'metodo' => 'required|string'
        ]);

        $user = User::find($request->user_id);
        $valor = floatval($request->valor);

        $user->credit += $valor;
        $user->save();

        return response()->json([
            'sucesso' => true,
            'novo_saldo' => $user->credit
        ]);
    }
}
