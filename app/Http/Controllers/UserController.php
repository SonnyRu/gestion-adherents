<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function edit(User $user)
    {
        if (Auth::user()->role !== 'president' && Auth::user()->role !== 'secretaire') {
            abort(403);
        }

        // Déchiffrez les données avant de les envoyer à la vue
        $user->name = decrypt($user->name);
        $user->first_name = decrypt($user->first_name);
        $user->email = $user->email;
        $user->phone_number = decrypt($user->phone_number);

        return view('edit-adherent.editad', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Ajoutez d'autres règles de validation selon vos besoins
        ]);

        $validatedData['name'] = encrypt($validatedData['name']);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8', // Validez le mot de passe ici
            ]);
            $validatedData['password'] = bcrypt($request->password);
        }

        // Mettre à jour les informations de l'utilisateur
        $user->update($validatedData);

        // Redirection avec un message de succès
        return redirect()->route('editad', ['user' => $user->id])->with('success', 'Profil mis à jour avec succès.');
    }
}