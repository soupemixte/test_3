<?php

namespace App\Http\Controllers;

use App\Models\Cellar;
use App\Models\Bottle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CellarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cellars = Cellar::all();
        return view('cellar.index', ['cellars' => $cellars]);
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
        return redirect()->route('cellar.create')->with('success', 'Cellier créé avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cellar $cellar)
    {
        // return $cellar;
        return view('cellar.show', ['cellar' => $cellar]);
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
    
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
    
        return redirect()->route('cellar.show', $cellar->id)->with('success', 'Cellar updated successfully.');
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
            // Redirect to the form to choose a cellar and add the bottle
            return view('cellar.add', compact('bottle'));
        }

        // If the user has no cellars, redirect to create a new cellar
        return redirect()->route('cellar.create')->with('warning', 'Please create a cellar first.');
    }

    
    public function storeBottle(Request $request)
    {
        $request->validate([
            'bottle_name' => 'required|string',
            'cellar_id' => 'required',
        ]);

        // Attach the bottle to the selected cellar
        $cellar = Cellar::findOrFail($request->cellar_id);
        $cellar->bottles()->attach($request->bottle_id);

        return redirect()->route('cellar.index')->with('success', 'Bottle added to your cellar successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cellar $cellar)
    {
        $cellar->delete();

        return redirect()->route('cellar.index')->with('success', 'Cellar deleted successfully.');
    }
}
