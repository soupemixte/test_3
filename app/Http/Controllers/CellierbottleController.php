<?php

namespace App\Http\Controllers;

use App\Models\Bottle;
use App\Models\Cellier_has_bottle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CellierbottleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cellier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $nouveau_bottle = Cellier_has_bottle::create([
            'Cellier_idCellier' => $request->Cellier_idCellier,
            'Bottle_id' => $request->Bottle_id,
            'quantity' => $request->quantity,
            'a_commander' => $request->a_commander,
            'bu' => $request->bu,
        ]);

        $cellierbottles = Cellier_has_bottle::count();
  
        $request->session()->put('qte', $cellierbottles);
    
        return redirect()->route('welcome');
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
    public function destroy(Bottle $bottle)
    {
        //
    }
}