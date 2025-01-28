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
    public function add(Request $request) {
        $request->validate([
            'bottle_id' => 'required|exists:bottles,id',
        ]);

        // Vérifier si la bouteille est déjà dans la liste future
        $existing = FutureList::where('user_id', Auth::id())
            ->where('bottle_id', $request->bottle_id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', "Cette bouteille est déjà dans votre future liste !");
        }

        FutureList::create([
            'user_id' => Auth::id(),
            'bottle_id' => $request->bottle_id,
        ]);

        return redirect()->back()->with('success', "Bouteille ajoutée à votre future liste !");
    }
}
