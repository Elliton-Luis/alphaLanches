<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        switch ($user->type) {
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
    public function storeUser(Request $request){
        $dados = $request->except('_token');
        if($dados['password'] !== $dados['confirmPassword']){
            return redirect()->back()->with('error','As Senhas não são iguais');
        }
        else if(User::where('email',$dados['email'])->exists()){
            return redirect()>back()->with('error','Email já cadastrado');
        }
        else{
            User::Create([
                'name' => $dados['name'],
                'email'=> $dados['email'],
                'password' => bcrypt($dados['password']),
                'telefone'=> $dados['telefone'],
                'cpf'=>$dados['cpf']
            ]);
            return redirect()->route('home.index')->with('success', 'Cadastrado com Sucesso');
        }
  }

    public function logoutUser(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('successLogout', 'Sessão deslogada com sucesso');
    }
}
