<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class verifyAdmin
{

    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->type !== 'admin'){
            return redirect()->route('home.index')->with('error','Você não tem permissão a esta área do sistema');
        }

        return $next($request);
    }
}
