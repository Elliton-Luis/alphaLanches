<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuardRequest;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\sendGuardMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendGuardRejectMail;


class GuardRequestController extends Controller
{
    public function guardConfirm(){
        $requests = GuardRequest::get();
        return view('guardconfirm', ['requests'=>$requests]);
    }

    public function acceptRequest(String $id){
        $request = GuardRequest::find($id);
        $token = Str::uuid()->toString();
        $user = User::create([
            'name' => $request['name'],
            'email'=> $request['email'],
            'password' => bcrypt($token),
            'telefone'=> $request['telefone'],
            'cpf'=>$request['cpf'],
            'type'=>'guard'
        ]);

        $dadosMail['name']=$user->name;
        $dadosMail['password']=$token;
        Mail::to($user->email)->send(new sendGuardMail($dadosMail));
        $request->delete();

        return redirect()->route('guardRequests.index')->with('success', 'Usuário '.$user->name.' Criado com sucesso');
    }

    public function rejectRequest(String $id, Request $request){
        $guard = GuardRequest::find($id);
        $dadosMail['name'] = $guard->name;
        $dadosMail['message'] = $request['MRejeitar'];
        Mail::to($guard->email)->send(new sendGuardRejectMail($dadosMail));
        $guard->delete();

        return redirect()->route('guardRequests.index')->with('success', 'Pedido Rejeitado');
    }
}
