<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class VerifyFuncAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()){
            if(auth()->user()->type == 'admin' || auth()->user()->type == 'func'){
                return $next($request);
            }
        }
        return redirect()->route('login')->with('error','Você não tem permissão a esta área do sistema');
    }
}