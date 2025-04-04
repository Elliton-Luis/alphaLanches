<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showlogin(){
        return view('login');
    }
    public function showCadastro(){
        return view('cadastro');
    }

    public function authUser(Request $request){
        $dados = $request->except('_token');

        if(!Auth::attempt($dados)){
            return redirect()->back()->with('errorAuth','Email ou Senha Incorretos');
        }

        return redirect()->route('home.index');
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

    public function logoutUser(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.index')->with('successLogout','Sessão deslogada com sucesso');
    }
}
