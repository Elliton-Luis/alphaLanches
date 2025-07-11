<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateUserController extends Controller
{
    public function showPainelUsuarios(){
        return view('painelUsuarios');
    }
}
