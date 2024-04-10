<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TrombinoscopeController extends Controller
{
    public function index()
    {
        $roles = ['FONDATEUR', 'SECRETAIRE', 'COACH', 'NAGEUR'];
        $usersByRole = [];

        foreach ($roles as $role) {
            $users = User::where('role', $role)->get();
            foreach ($users as $user) {
                $user->first_name = decrypt($user->first_name);
                $user->name = decrypt($user->name);
            }
            $usersByRole[$role] = $users;
        }

        return view('trombinoscope', ['usersByRole' => $usersByRole]);
    }
}
