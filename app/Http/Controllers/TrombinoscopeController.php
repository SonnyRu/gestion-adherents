<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrombinoscopeController extends Controller
{
    public function index()
    {
        if (Auth::check() && (Auth::user()->role === 'president' || Auth::user()->role === 'secretaire')) {
            $roles = ['PRESIDENT', 'SECRETAIRE', 'COACH', 'NAGEUR'];
            $usersByRole = [];

            foreach ($roles as $role) {
                $users = User::where('role', $role)->where('acceptpartagedonnees', true)->get();
                foreach ($users as $user) {
                    $user->first_name = decrypt($user->first_name);
                    $user->name = decrypt($user->name);
                }
                $usersByRole[$role] = $users;
            }        

            return view('trombinoscope', ['usersByRole' => $usersByRole]);
        } else {
            return view('auth.login');
        }
    }
}
