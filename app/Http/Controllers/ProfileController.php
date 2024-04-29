<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        // Déchiffrer les données
        $user->name = decrypt($user->name);
        $user->first_name = decrypt($user->first_name);
        $user->email = $user->email;
        $user->phone_number = decrypt($user->phone_number);

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {        
        
        $user = $request->user();
        
        // Remplacer les données de l'utilisateur par les données validées du formulaire
        $user->fill($request->validated());

        // Crypter les nouvelles données
        $encryptedData = [
            'name' => Crypt::encrypt($request->input('name')),
            'first_name' => Crypt::encrypt($request->input('first_name')),
            'phone_number' => Crypt::encrypt($request->input('phone_number')),
            'acceptpartagedonnees' => $request->has('acceptpartagedonnees'),
        ];

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
    
        $user->update($encryptedData);
        
        Log::channel('modif')->info('L\'utilisateur ' . $user->id . ' a modifié son profil');
        
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function index(Request $request)
{
    // Récupérer tous les utilisateurs
    $users = User::all();

    // Décrypter les données de chaque utilisateur
    foreach ($users as $user) {
        $user->name = Crypt::decrypt($user->name);
        $user->first_name = Crypt::decrypt($user->first_name);
        $user->email = $user->email; // Laissez l'email non modifié car il n'est pas crypté
        $user->phone_number = Crypt::decrypt($user->phone_number);
    }

    // Passer les utilisateurs à la vue
    return view('list', ['users' => $users]);
}


public function indexannuaire(Request $request)
{
    // Récupérer tous les utilisateurs
    $users = User::all();

    // Décrypter les données de chaque utilisateur
    foreach ($users as $user) {
        $user->name = Crypt::decrypt($user->name);
        $user->first_name = Crypt::decrypt($user->first_name);
        $user->email = $user->email; // Laissez l'email non modifié car il n'est pas crypté
        $user->phone_number = Crypt::decrypt($user->phone_number);
    }

    // Passer les utilisateurs à la vue
    return view('annuaire', ['users' => $users]);
}
    

}


