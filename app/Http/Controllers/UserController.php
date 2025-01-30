<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cellar;
use App\Models\Bottle;
use App\Models\CellarBottle;
use App\Models\FutureList;
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
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [ 
            'required',
            // 'min:6',
            Password::min(2) 
            ->letters() 
            ->mixedCase() 
            ->numbers(), ],
            // 'password_confirmation' => 'required',
            ]);
        if($validate) { 
            // return "cool"; 
            $user = new User;
            $user->fill($request->all());
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect(route('user.login'))->withSuccess('Usager créé avec succès, veuillez bien vous connecter.');
        }
        // elseif(!$validate) {
        //     return redirect(route('user.create'))->withError('Veuillez bien remplir le formulaire.');
        // }
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Initialiser $cellars comme un tableau vide par défaut
        $cellars = collect();

        $list = FutureList::where('user_id', Auth::user()->id)
            ->exists();
        // return $list;
    
        if (Auth::user()->hasCellar()) {
            $cellars = Cellar::where('user_id', Auth::user()->id)
                ->get();
            // return $cellars;
            $count = $cellars->count();
            foreach ($cellars as $cellar) {
                # code...
                $cellar_bottles = CellarBottle::where('cellar_id', $cellar->id)
                    // ->where('user_id', '=', Auth::user()->id)
                    ->get();
            }
            $total = 0;
            foreach ($cellar_bottles as $cellar_bottle) {
                $total += $cellar_bottle->quantity;
            }
            $facture = 0;
            $arrayBottle = [];
            // return $list;
            if($list){
                $list = FutureList::where('user_id', Auth::user()->id)
                ->get();
                // return "ici";
                foreach ($list as $item) {
                    $bottles = Bottle::where('id', $item->bottle_id)
                        ->get();
                    $val = intval($bottles->first()->price);
                    if($cellar_bottles) {
                        foreach ($cellar_bottles as $cellar_bottle) {
                            if($cellar_bottle->bottle_id == $item->bottle_id) {
                                $facture += $val * $cellar_bottle->quantity;
                            }
                        }

                    }
                }
                // return $total;
                // return $facture;
                return view('user.show', ['user' => $user], compact('cellars', 'bottles' ,'total', 'count', 'list', 'facture'));
            } else {
                // return "la";
                return view('user.show', ['user' => $user], compact('cellars' ,'total', 'count', 'list'));
            }
            
        }
        return redirect()->route('cellar.create')->withWarning('Veuillez vous créer un cellier.');

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
