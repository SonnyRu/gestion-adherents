<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListADController extends Controller
{
    public function index()
    {
        // Vérif si l'utilisateur est président ou secrétaire
        if (Auth::check() && (Auth::user()->role === 'president' || Auth::user()->role === 'secretaire')) {
            // retourner la vue de annuaire 
            return view('list');
        } else {
            //
            abort(403); // accès pas autorisé
        }
    }
}