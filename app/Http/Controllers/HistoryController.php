<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function showHistory(){
        return view('history');
    }
}
