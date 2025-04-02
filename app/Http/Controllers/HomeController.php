<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homeAdmin(){
        return view('homes.homeAdmin');
    }

    public function homeFunc(){
        return view('homes.homeFunc');
    }

    public function homeStudent(){
        return view('homes.homeStudent');
    }

    public function homeGuard(){
        return view('homes.homeGuard');
    }
}
