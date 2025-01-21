<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        return back()->withErrors(['email' => 'Informations non valides.'])->withInput();
    }

    //Tableau de bord d'administration
    public function dashboard() {
        return view('admin.dashboard');
    }

    //Déconnexion de l'administrateur
    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Déconnexion réussie.');
    }
}
