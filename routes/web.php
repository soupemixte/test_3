<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\CellierBottleController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/bottles', [BouteilleController::class, 'index'])->name('bottle.index');
Route::get('/bottle/{id}', [BouteilleController::class, 'details'])->name('bottle.details');
Route::get('/scrape-bouteilles', [BouteilleController::class, 'scrape'])->name('bottle.scrape');
Route::get('/cellier/create', [CellierController::class, 'create'])->name('cellier.create');
Route::post('/bottle', [CellierBottleController::class, 'store'])->name('cellierbottle.store');
