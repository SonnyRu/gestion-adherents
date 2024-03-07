<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Vérifier si l'utilisateur est authentifié
        if ($user) {
            // Déchiffrer les données de l'utilisateur
            $user->name = decrypt($user->name);
            $user->first_name = decrypt($user->first_name);
            // Ajoutez d'autres attributs si nécessaire

            // Passer les données de l'utilisateur à la vue du tableau de bord
            return view('dashboard', ['user' => $user]);
        } else {
            // Si l'utilisateur n'est pas authentifié, rediriger vers la page de connexion
            return redirect()->route('login');
        }
    }
}
