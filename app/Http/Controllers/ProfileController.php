<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Crypt;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        // Déchiffrer les données
        $user->name = decrypt($user->name);
        $user->first_name = decrypt($user->first_name);
        $user->email = decrypt($user->email);
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
        ];

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user->update($encryptedData);

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
}
