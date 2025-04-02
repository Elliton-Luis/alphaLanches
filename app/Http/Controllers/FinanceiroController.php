<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    public function showFinanceiro(){
        return view('financeiro');
    }
}
