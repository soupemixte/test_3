<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Bottle;

class AdminController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm() {
        return view('admin.login');
    }

    // Gérer la connexion admin
    public function login (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Connecté avec succès.');
        }
        else {

            return redirect()->route('admin.login')->withErrors('Combinaison e-mail / mot de passe incorrecte.');
        }
    }

    //Tableau de bord d'administration
    public function dashboard() {
        // le nombre total de bouteilles dans la BD
        $totalBottles = Bottle::count();

        return view('admin.dashboard', compact('totalBottles'));
    }

    //Déconnexion de l'administrateur
    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->withSuccess('Déconnexion réussie.');
    }
}
