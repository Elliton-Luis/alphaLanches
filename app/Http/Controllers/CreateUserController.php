<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateUserController extends Controller
{
    public function showIndex(){
        return view('accounts.home');
    }
}
