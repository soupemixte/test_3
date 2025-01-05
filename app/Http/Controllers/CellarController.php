<?php

namespace App\Http\Controllers;

use App\Models\Cellar;
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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => 1
        ]);
    
        return redirect()->route('cellar.show', $task->id)->with('success', 'Cellar created successfully.');
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
            'title' => 'required|string|max:255|unique:cellars',
            'description' => 'required|string',
        ]);
    
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
    
        return redirect()->route('cellar.show', $cellar->id)->with('success', 'Cellar updated successfully.');
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
