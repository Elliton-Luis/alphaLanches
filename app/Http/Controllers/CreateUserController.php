<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateUserController extends Controller
{
    public function showIndex(){
        return view('accounts.home');
    }
    public function showPainelUsuarios(){
        return view('painel.usuarios');
    }
    public function showPainelCompras(){
        return view('painel.compras');
    }
    public function showPainelPDV(){
        return view('painel.pdv');
    }
}
