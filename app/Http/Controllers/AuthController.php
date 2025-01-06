<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|max:20'
        ]);
        $credentials = $request->only('email', 'password');
        if(!Auth::validate($credentials)):
            return redirect(route('login'))
                        ->withErrors(trans('auth.failed'))
                        ->withInput();
        endif;
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        /* return redirect(route('user.index'))->withSuccess('Signed in'); */
        /* return redirect(route('cellar.create'))->withSuccess('Signed in'); */
        //Redirect regarding if the connected user has a cellar
        if ($user->hasCellar()) {
            $route = 'cellar.index';
        } else {
            $route = 'cellar.create';
        }
        return redirect(route($route))->withSuccess('Signed in');

        echo $user;
        $request->session()->put('user', $user);
        return redirect()->intended(route('welcome'))->withSuccess('Signed in');
      //  die();
     //   return redirect()->intended(route('task.index'))->withSuccess('Signed in');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //Session::flush();
        Auth::logout();
        return redirect(route('login'));
        
    }
}
