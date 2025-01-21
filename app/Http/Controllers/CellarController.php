<?php

namespace App\Http\Controllers;

use App\Models\Cellar;
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
    }

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

        //Create the cellar
        Cellar::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        // if worked
        return redirect()->route('cellar.index')->withSuccess('Cellier créer avec succes !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cellar $cellar) 
    {
        // Retrieve bottles associated with this cellar
        $bottles = $cellar->bottles()->orderBy('title')->paginate(10);
        $cellar_bottles = CellarBottle::select()
            ->where('cellar_id', '=', $cellar->first()->id)
            ->get();
        // Debug the result
        if ($bottles->isEmpty()) {
            return redirect()->route('bottle.index');
        }

        if (Auth::user()->hasCellar()) {
            // Return to cellar show view with all the bottles
                return view('cellar.show', [
                    'cellar' => $cellar,
                    'bottles' => $bottles,
                    'cellar_bottles' => $cellar_bottles,
                ]);
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
            'title' => 'required|string|max:255|unique:cellars',
            'description' => 'required|string',
        ]);
    
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
    
        return redirect()->route('cellar.show', $cellar->id)->withSuccess('Cellier mit à jour.');
    }

    /**
     * Function to add the bottle to the cellar
     */
    public function add($id)
    {
        // Retrieve the bottle by its ID
        $bottle = Bottle::findOrFail($id);

        // Check if the user has any cellars
        if (Auth::user()->hasCellar()) {
            $cellar = Cellar::where('user_id', Auth::user()->id);
            $cellar_id = $cellar->first()->id;
            $cellar_bottle = CellarBottle::select()
            ->where('cellar_id', '=', $cellar_id)
            ->where('bottle_id', '=', $id)
            ->exists();
            if($cellar_bottle) 
            { 
                $cellar_bottle = CellarBottle::select()
                    ->where('cellar_id', '=', $cellar_id)
                    ->where('bottle_id', '=', $id)
                    ->get();
                $bd_quantity = $cellar_bottle->first()->quantity; 
            }
            else { $bd_quantity = 0; }
            // Redirect to the form to choose a cellar and add the bottle with quantity
            return view('cellar.add', compact('bottle'), ['quantity' => $bd_quantity]);
        }
        // If the user has no cellars, redirect to create a new cellar
        return redirect()->route('cellar.create')->withWarning('Veuillez créer un cellier.');
    }

    
    public function storeBottle(Request $request)
    {
        $bottle = Bottle::findOrFail($request->input('bottle_id'));

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
            // $set_quantity = $bd_quantity + $request->input('quantity');

            if($request->input('quantity') < 1) {
                // return "Not enough bottles in cellar."
                return view('cellar.add', compact('bottle'), ['quantity' => $bd_quantity])->withWarning( 'Pas assez de Bouteilles dans le Cellier.');
            }
            if($request->input('quantity') === $bd_quantity) {
                // return "Not enough bottles in cellar."
                return view('cellar.add', compact('bottle'), ['quantity' => $bd_quantity])->withError( 'Veuillez modifier la quantité.');
            }
            CellarBottle::where('cellar_id', '=', $request->input('cellar_id'))
                ->where('bottle_id', '=', $request->input('bottle_id'))
                ->update([
                    'quantity' => $request->input('quantity'),
                ]);
        }
        else {

            if($request->input('quantity') < 0) {
                // return "Cannot add negative number";
                return view('cellar.add', compact('bottle'), ['quantity' => $request->input('quantity')])->withWarning( 'Erreur de gestion de cellier');
            }
            // Attach the bottle to the selected cellar
            CellarBottle::create([
                'cellar_id' => $request->input('cellar_id'),
                'bottle_id' => $request->input('bottle_id'),
                'quantity' => $request->input('quantity'),
            ]);

        }
        
        return redirect()->route('cellar.index')->withSuccess( 'Bottle added to your cellar successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cellar $cellar)
    {
        $cellar->delete();

        return redirect()->route('cellar.index')->withSuccess('Cellar deleted successfully.');
    }
}
