<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showlogin()
    {
        return view('login');
    }
    public function showCadastro()
    {
        return view('cadastro');
    }

    public function authUser(Request $request)
    {
        $dados = $request->except('_token');

        if (!Auth::attempt($dados)) {
            return redirect()->back()->with('errorAuth', 'Ta errado seu burro estupido');
        }

        $user = Auth::user();

        switch ($user->tipo) {
            case 'admin':
                return redirect()->route('home.admin');
            case 'func':
                return redirect()->route('home.func');
            case 'student':
                return redirect()->route('home.student');
            case 'guard':
                return redirect()->route('home.guard');
            default:
                Auth::logout();
                return redirect()->route('login')->with('errorAuth', 'Tipo de usuário inválido.');

        }
    }
    public function storeUser(Request $request)
    {
        dd($request);
    }

    public function logoutUser(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('successLogout', 'Sessão deslogada com sucesso');
    }
}
