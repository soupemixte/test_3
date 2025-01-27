<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cellar;
use App\Models\Bottle;
use App\Models\CellarBottle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select()
        ->orderby('name')
        ->paginate(10);
        // return $users;
        return view('user.index', ['users' => $users]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [ 
            'required', 
            'max:20', 
            'min:6',
            Password::min(2) 
            ->letters() 
            ->mixedCase() 
            ->numbers() , 
            'confirmed' ],
            'password_confirmation' => 'required',
            ]);
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        // return $user->email;
        //
        return redirect(route('user.login', ['user' => $user]))->withSuccess('Usager créé avec succès, veuillez bien vous connecter.');
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
       
        $cellars = collect();
    
        if (Auth::user()->hasCellar()) {
            $cellars = Cellar::where('user_id', Auth::user()->id)
                ->get();
<<<<<<< HEAD
=======
            // foreach ($cellars as $cellar) {
            //     # code...
            //     $cellar_bottles = CellarBottle::where('cellar_id', $cellar->id)
            //         -where('user_id', '=', Auth::user()->id)
            //         ->get();
            // }
            // return $bottles;
            // return $cellars;
            return view('user.show', ['user' => $user], compact('cellars'));
>>>>>>> 25d1b0574e8ad72a393a659f08a976daccf8f0b3
        }
        
    
        return view('user.show', compact('user', 'cellars'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', ['user'=>$user]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users',
        ]); 

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
        ]);

        return redirect()->route('user.show', $user->id)->withSuccess('Usager # '.$user->id.' : '.$user->name.' mis à jour avec succès.');
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        return redirect()->route('user.login')->withSuccess('Usager : '.$name.' supprimer avec succes et déconnexion réussie.');

        // return redirect()->route('user.index')->withSuccess('Usager supprimer avec succes.');
    }
}
