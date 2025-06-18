<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\GuardRequest as GR;

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
        $request->validate([
            'email' => 'required|email|max:254',
            'password' => 'required|string|max:27',
        ]);

        $dados = $request->except('_token');

        if (!Auth::attempt($dados)) {
            return redirect()->back()->with('errorAuth', 'Email ou Senha Incorreto');
        }
        return redirect('home')->with('success', 'login realizado com sucesso');
    }
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:254',
            'telefone' => 'string|max:16',
            'cpf' => 'string|max:14',
            'confirmacao' => 'required|boolean',
        ]);

        if ($validated['confirmacao'] == 1) {
            $existsInGR = GR::where('cpf', $validated['cpf'])
                ->orWhere('email', $validated['email'])
                ->orWhere('telefone', $validated['telefone'])
                ->exists();

            if ($existsInGR) {
                return redirect()->back()->with('errorAuth', 'Você já tem um pedido em aberto, qualquer dúvida entrar em contato com o administrador');
            }

            $existsInUser = User::where('cpf', $validated['cpf'])
                ->orWhere('email', $validated['email'])
                ->orWhere('telefone', $validated['telefone'])
                ->exists();

            if ($existsInUser) {
                return redirect()->back()->with('errorAuth', 'Usuário já cadastrado, qualquer dúvida entrar em contato com o administrador');
            }

            GR::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'telefone' => $validated['telefone'],
                'cpf' => $validated['cpf']
            ]);

            return redirect()->route('login')->with('success', 'Request enviado com sucesso, por favor aguarde confirmação');
        }

        $existsUser = User::where('email', $validated['email'])->exists();
        if ($existsUser) {
            return redirect()->back()->with('errorAuth', 'Email já cadastrado');
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'telefone' => $validated['telefone'],
            'cpf' => $validated['cpf']
        ]);

        return redirect()->route('login')->with('success', 'Cadastrado com Sucesso');
    }

    public function logoutUser(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('successLogout', 'Sessão deslogada com sucesso');
    }
}
