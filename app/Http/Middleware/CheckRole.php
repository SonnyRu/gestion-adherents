<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        }

        foreach ($roles as $role) {
            if (Auth::user()->hasRole($role)) {
                return $next($request); // L'utilisateur a le rôle requis, donc on le laisse passer
            }
        }

        return redirect()->route('non_authorized'); // Rediriger vers la page non_authorized si l'utilisateur n'a pas le rôle requis
    }
}
