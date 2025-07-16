<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyAuthAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você não tem permissão a esta área do sistema');
        }

        if (!Auth::user()->isAdmin() && Auth::user()->type !== 'func') {
            abort(403, 'Acesso negado.');
        }

        return $next($request);
    }
}