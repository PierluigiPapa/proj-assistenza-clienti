<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLogin
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica se l'utente è autenticato e se il campo booleano è impostato a 1
        if (Auth::check() && Auth::user()->boolean_field == 1) {
            // Reindirizza l'utente alla pagina front-end di Vue.js
            return redirect()->away('http://localhost:5174/user');
        }

        return $next($request);
    }
}
