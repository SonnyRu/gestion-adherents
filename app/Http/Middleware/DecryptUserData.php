<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DecryptUserData
{
    public function handle($request, Closure $next)
    {
        if ($user = Auth::user()) {
            $user->name = decrypt($user->name);
            $user->first_name = decrypt($user->first_name);
            $user->phone_number = decrypt($user->phone_number);
            // Ajoutez d'autres attributs à déchiffrer si nécessaire
        }

        return $next($request);
    }
}
