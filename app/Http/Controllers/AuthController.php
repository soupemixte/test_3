<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Sélection du rôle d'authentification (utilisateur, administrateur)
     */
    public function chooseConnection()
    {
        return view('auth.connection');
    }
    /**
     * Show the user login form.
     */
    public function showUserLoginForm()
    {
        return view('auth.user-login'); // View for user login
    }

    /**
     * Handle user login.
     */
    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|max:20',
        ]);


        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $redirect = $user->hasCellar() ? 'cellar.index' : 'cellar.create';
            return redirect()->route($redirect)->withSuccess('Connecté.');
        }

        return redirect()->route('user.login')->withErrors('Combinaison e-mail / mot de passe incorrecte.');
    }

    /**
     * Show the admin login form.
     */
    public function showAdminLoginForm()
    {

        return view('auth.admin-login'); // View for admin login
    }

    /**
     * Handle admin login.
     */
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins',
            'password' => 'required|min:6|max:20',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.dashboard')->withSuccess('Administrateur connecté avec succès !');
        }

        return redirect()->route('admin.login')->withErrors('Combinaison e-mail / mot de passe incorrecte.');
    }

    /**
     * Handle logout for both users and admins.
     */
    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        return redirect()->route('user.login')->withSuccess('Déconnexion réussie.');
    }
}
