<?php

namespace App\Http\Controllers;

use App\Models\Cellar;
use App\Models\User;
use App\Models\Bottle;
use App\Models\CellarBottle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CellarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasCellar()) {
            $cellars = Cellar::select()
                ->where('user_id', '=', Auth::id())
                ->get();
            
            // Redirect to cellar index with cellars
            return view('cellar.index', ['cellars' => $cellars]);
         
        }
        // If the user has no cellars, redirect to create a new cellar
        return redirect()->route('cellar.create')->withWarning('Veuillez bien créer un cellier.');

    }


  /*
    public function switch($id)
    {
        $bottle = Bottle::findOrFail($id);
        $cellars = Cellar::all();
            // Redirect to cellar add page
            return view('Cellar.add',['bottle'=>$bottle , 'cellars' => $cellars]);
         
        
    }
    */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cellar.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);
        $user = User::select()
            ->where('id', '=', Auth::id())
            ->get();
        //Create the cellar
        $name = $request->input('title');
        $cellar = Cellar::select()
            ->where('title', '=', $name)
            ->where('user_id', '=', Auth::id())
            ->exists();
        if($cellar) {
            // TODO: return errors and old value
            return redirect()->route('cellar.create')->withError('Vous avez deja un cellier avec ce nom : '.$name);
        };
        // Create Cellar
        $cellar = Cellar::create([
            'user_id' => Auth::id(),
            'title' => $name,
            'description' => $request->input('description'),
        ]);

        // Retrieve the cellar ID from the session
        $request->session()->put('cellar_id', $cellar->id);
        
        // if worked
        return redirect()->route('cellar.index')->withSuccess('Cellier '.$name.' créé avec succès !');
    }


    /**
     * Display the specified resource.
     */
    public function show(Cellar $cellar, Request $request) 
    {
        $colors = $cellar->bottles()->distinct()->pluck('color')->filter()->all();
        $countries = $cellar->bottles()->distinct()->pluck('country')->filter()->all();
        $sizes = $cellar->bottles()->distinct()->pluck('size')->filter()->all();
        // return $sizes;
       
        // Check if the query or filters exist
        $query = $request->input('search');
        $filter = $request->input('order');
        $color = $request->input('color');
        $country = $request->input('country');
        $size = $request->input('size');
    
        // Base query
        $bottlesQuery = $cellar->bottles();;

        // Apply filters if provided
        
        if (!empty($query)) {
            $bottlesQuery->where('title', 'LIKE', '%' . $query . '%');
        }
        if (!empty($color)) {
            $bottlesQuery->where('color', $color);
        }
        if (!empty($country)) {
            $bottlesQuery->where('country', $country);
        }
        if (!empty($size)) {
            $bottlesQuery->where('size', $size);
        }

        if ($filter) { $order = $filter; }
        else {
            $order = 'title';
        }
        // Get filtered results
        $bottles = $bottlesQuery->orderby($order)->paginate(5);

        $cellar_bottles = CellarBottle::where('cellar_id', $cellar->id)->get();
        
        if (Auth::user()->hasCellar()) {
            // Return to cellar show view with all the bottles
            return view('cellar.show', compact('cellar', 'cellar_bottles', 'bottles', 'query', 'sizes', 'order', 'colors', 'countries', 'color', 'country', 'size'));
        }
        
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cellar $cellar)
    {
        return view('cellar.edit', ['cellar'=>$cellar]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cellar $cellar)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $name = $request->input('title');
            
        $cellar = Cellar::select()
            ->where('user_id', '=', Auth::id())
            ->where('title', '=', $name)
            ->get()
            ->first();
        if($cellar)
        {
            return redirect()->route('cellar.edit', ['cellar'=>$cellar])->withError('Vous avez deja un cellier avec ce nom : '.$name);
        }
        else 
        {
            $cellar->update([
                'title' => $name,
                'description' => $request->input('description'),
            ]);

            return redirect()->route('cellar.show', $cellar->id)->withSuccess('Cellier mis à jour.');
        };
    }
       


    /**
     * Function to add the bottle to the cellar
     */
    public function add(Request $request , $id)
    {

        // Retrieve the bottle by its ID
        $bottle = Bottle::findOrFail($id);
        // Check if the user has any cellars
        if (Auth::user()->hasCellar()) {
            // $first_cellar = Cellar::where('user_id', Auth::user()->id)->first();
            // Redirect to the form to choose a cellar and add the bottle with quantity
            return view('cellar.add', compact('bottle'));
        }
        // If the user has no cellars, redirect to create a new cellar
        return redirect()->route('cellar.create')->withWarning('Veuillez bien créer un cellier.');
    }

    /**
     * Function to add the bottle to the cellar
     */
    public function remove($id, $cellar_id)
    {
        // Retrieve the bottle by its ID
        $bottle = Bottle::findOrFail($id);
        // Check if the user has any cellars
        if (Auth::user()->hasCellar()) {
            $cellar_bottle = CellarBottle::select()
            ->where('cellar_id', '=', $cellar_id)
            ->where('bottle_id', '=', $id)
            ->exists();
            if($cellar_bottle) {
                $cellar_bottle = CellarBottle::select()
                ->where('cellar_id', '=', $cellar_id)
                ->where('bottle_id', '=', $id)
                ->get();
                
                $bd_quantity = $cellar_bottle->first()->quantity;
            }
            return view('cellar.remove', compact('bottle'), ['cellar' => $cellar_bottle->first()]);
        }
        // If the user has no cellars, redirect to create a new cellar
        return redirect()->route('cellar.create')->withWarning('Veuillez bien créer un cellier.');
    }

    
    /**
     * 
     */
    public function storeBottle(Request $request)
    {
        $bottle = Bottle::findOrFail($request->input('bottle_id'));
        // $first_cellar = Cellar::where('user_id', Auth::user()->id)->first();
        $request->validate([
           'cellar_id' => 'required',
           'bottle_id' => 'required',
            'quantity' => 'required|min:0',
        ]);
        $cellar_bottle = CellarBottle::select()
            ->where('cellar_id', '=', $request->input('cellar_id'))
            ->where('bottle_id', '=', $request->input('bottle_id'))
            ->exists();
        if($cellar_bottle) {
            $cellar_bottle = CellarBottle::select()
                ->where('cellar_id', '=', $request->input('cellar_id'))
                ->where('bottle_id', '=', $request->input('bottle_id'))
                ->get();
            $bd_quantity = $cellar_bottle->first()->quantity;
            $result = intval($request->input('quantity')) + $bd_quantity;
            return $result;
            if($request->input('quantity') < 1) {
                // return "Not enough bottles in cellar.";
                return view('cellar.add', compact('bottle'))->withWarning('Pas assez de bouteilles dans le cellier.');
            }

            CellarBottle::where('cellar_id', '=', $request->input('cellar_id'))
                ->where('bottle_id', '=', $request->input('bottle_id'))
                ->update([
                    'quantity' => $result ,
                ]);
        }
        else {
            if($request->input('quantity') < 1) {
                // return "Cannot add negative number";
                return redirect()->route('cellar.add', compact('bottle'), ['quantity' => $request->input('quantity')])->withSuccess('Erreur de gestion du cellier.');
            }
            // Attach the bottle to the selected cellar
            CellarBottle::create([
               'cellar_id' => $request->input('cellar_id'),
                'bottle_id' => $request->input('bottle_id'),
                 'quantity' => $request->input('quantity'),
            ]);

        }
        // Vous avez ajoutez
       
        return redirect()->route('cellar.show', $request->input('cellar_id'))->withSuccess('Vous avez ajouté '.$request->input('quantity').' bouteilles à votre cellier avec succès.');
    }

    public function removeBottle(Request $request)
    {
        $bottle = Bottle::findOrFail($request->input('bottle_id'));
        $to_cellar = $request->input('to_cellar_id');
        // return $to_cellar;
        $request->validate([
            'cellar_id' => 'required',
            'bottle_id' => 'required',
            'quantity' => 'required',
        ]);

        $cellar_bottle = CellarBottle::select()
        ->where('bottle_id', '=', $request->input('bottle_id'))
        ->where('cellar_id', '=', $request->input('cellar_id'))
        ->get();
        if($cellar_bottle) {
        
            $bd_quantity = $cellar_bottle->first()->quantity;
            $result = $bd_quantity - intval($request->input('quantity'));
            // return $result;
            if($result < 0) {
                // return "Not enough bottles in cellar."
                return view('cellar.remove', compact('bottle'), ['cellar' => $cellar_bottle->first()])->withWarning('Pas assez de bouteilles dans le cellier.');
            }
            else if($result === 0) {
                // return "ici";
                $cellar_bottle = CellarBottle::select()
                ->where('bottle_id', '=', $request->input('bottle_id'))
                ->where('cellar_id', '=', $request->input('cellar_id'))
                ->delete();

                if($to_cellar) {
                    CellarBottle::create([
                        'cellar_id' => $to_cellar,
                        'bottle_id' => $request->input('bottle_id'),
                        'quantity' => $request->input('quantity'),
                        ]);
                }
                // return "No bottles left in cellar."
                return redirect()->route('cellar.index')->withSuccess('Il ne vous reste plus '.$bottle->first()->title.' dans votre cellier.');
            }
            else {
                // return $to_cellar;
                $cellar_bottle = CellarBottle::select()
                ->where('bottle_id', '=', $request->input('bottle_id'))
                ->where('cellar_id', '=', $request->input('cellar_id'))
                ->update([
                    // 'cellar_id' => $to_cellar,
                    'quantity' => $result,
                ]);

                if($to_cellar) { 
                    // $to_cellar_exist = Cellar::select()
                    //     ->where('id', '=', $to_cellar)
                    //     ->get();

                    $to_cellar_bottle = CellarBottle::select()
                        ->where('bottle_id', '=', $request->input('bottle_id'))
                        ->where('cellar_id', '=', $to_cellar)
                        ->exists();

                    if($to_cellar_bottle) {
                        $to_cellar_bottle = CellarBottle::select()
                        ->where('bottle_id', '=', $request->input('bottle_id'))
                        ->where('cellar_id', '=', $to_cellar)
                        ->get();
                        // return "ici";
                        $to_bd_quantity = $to_cellar_bottle->first()->quantity;
                        // return $to_bd_quantity;
                        $to_result = intval($request->input('quantity')) + $to_bd_quantity;
                        // return $to_result;
                        // return "Cellar bottle exists";
                        CellarBottle::where('bottle_id', '=', $request->input('bottle_id'))
                        ->where('cellar_id', '=', $to_cellar)
                        ->update([
                            'quantity' => $to_result,
                        ]);
                    } else {
                        // return "Cellar bottle doesnt exist but cellar does";
                        CellarBottle::create([
                            'cellar_id' => $to_cellar,
                            'bottle_id' => $request->input('bottle_id'),
                            'quantity' => $request->input('quantity'),
                            ]);
                    } 
                }
            }
            return redirect()->route('cellar.show', $request->input('cellar_id'))->withSuccess('Vous avez retiré '.$request->input('quantity').' bouteilles de votre cellier avec succès.');
            }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cellar $cellar)
    {
        // return $cellar;
        $cellar->delete();
        //
        return redirect()->route('cellar.index')->withSuccess('Cellier supprimer avec succes.');
    }

}