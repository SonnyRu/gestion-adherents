<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        if (Auth::user() and (Auth::user()->role == "president" or Auth::user()->role == "secretaire")) {
        // if (Auth::user()->role == "president" or Auth::user()->role == "secretaire") {
            return view('auth.register');
        } else {
            return view('non_authorized');
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone_number' => ['required', 'string', 'max:20'],
            'role' => ['required', 'string', 'max:255'],
            'acceptpartagedonnees' => ['required', 'boolean'],
            'acceptpolitique' => ['required', 'boolean'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = User::create([
            'name' => encrypt($request->name),
            'first_name' => encrypt($request->first_name),
            'email' => $request->email,
            'phone_number' => encrypt($request->phone_number),
            'role' => $request->role,
            'acceptpartagedonnees' => filter_var($request->acceptpartagedonnees, FILTER_VALIDATE_BOOLEAN),
            'acceptpolitique' => filter_var($request->acceptpolitique, FILTER_VALIDATE_BOOLEAN),
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));

        $user = Auth::user();

    if ($user) {
        
        if (Auth::check()) {
            return redirect()->route('register')->with('status', 'profile-registered');
        }
        Auth::login($user);
        
        Log::channel('connexion')->info('Le compte de ' . $request->name .' '. $request->first_name. ' vient d\'être créé');

        return redirect(RouteServiceProvider::HOME);
    } else {
        return back()->withErrors(['registration' => 'Failed to register user']);
    }
    }
}