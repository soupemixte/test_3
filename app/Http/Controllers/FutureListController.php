<?php

namespace App\Http\Controllers;

use App\Models\FutureList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FutureListController extends Controller
{
    /**
     * Ajoutez la bouteille à la liste future
     */
    public function add(Request $request, $id) {
        $user = Auth::user();

        // Vérifier si la bouteille est déjà dans la liste future
        $exists = FutureList::where('user_id', $user->id)
            ->where('bottle_id', $id)
            ->exists();

        
        if ($exists) {
           // message si la bouteille est déjà ajoutée
            return redirect()->back()->with('error', "Cette bouteille est déjà dans votre future liste.");
        }

        FutureList::create([
            'user_id' => $user->id,
            'bottle_id' => $id,
        ]);

        return redirect()->back()->with('success', "Bouteille ajoutée à votre future liste !");
    }
}
