<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateStudentController extends Controller
{
    public function showPainelStudents(){
        return view('painelStudents');
    }
}
