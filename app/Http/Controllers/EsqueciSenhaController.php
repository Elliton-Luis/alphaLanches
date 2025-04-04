<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EsqueciSenhaController extends Controller
{
    public function showEsqueciSenha(){
        return view('esqueciSenha');
    }
}
