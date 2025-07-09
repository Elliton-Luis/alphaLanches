<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RecargaClienteController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('recargaCliente', compact('users'));
    }
}
