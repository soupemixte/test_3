<?php

namespace App\Http\Controllers;

use App\Models\Bottle;
use App\Models\CellarBottle;
use App\Models\Cellier_has_bottle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CellarBottleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cellarbottle.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
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
    public function show(Bottle $bottle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bottle $bottle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bottle $bottle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
       
    }

    public function del($id)
    {
    
        $cellar_bottle = CellarBottle::select()
        ->where('bottle_id', '=', $id)
        ->where('cellar_id', '=', session('id_cellier'))
        ->exists();
    
    
    if($cellar_bottle) {
        $cellar_bottle = CellarBottle::select()
            ->where('bottle_id', '=', $id)
            ->where('cellar_id', '=', session('id_cellier'))
            ->delete();

            return redirect()->route('cellar.index')->withSuccess('Bouteille enlevée avec succes!!!');
    }
}
}