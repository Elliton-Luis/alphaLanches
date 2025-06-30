<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RecargaController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('recarga', compact('users'));
    }
}
