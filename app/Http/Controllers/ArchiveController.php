<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Archive;

class ArchiveController extends Controller
{
    public function archive($userId)
    {
        // recup le user
        $user = User::findOrFail($userId);

        // Copier les données de users
        Archive::create([
            'id' => $user->id,
            'name' => $user->name,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'role' => $user->role, 
        ]);

        // Supprimer l'user de users
        $user->delete();

        return redirect()->back()->with('success', 'Utilisateur archivé avec succès');
    }
}