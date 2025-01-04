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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cellar $cellar)
    {
        return view('cellar.show', ['cellar' => $cellar]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cellar $cellar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cellar $cellar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cellar $cellar)
    {
        //
    }
}
