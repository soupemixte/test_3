<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\UserController;

// TODO: Remove this
Route::get('/', function () {
    return view('welcome');
});

// Bottles Route
Route::get('/bottles', [BouteilleController::class, 'index'])->name('bottle.index');
Route::get('/bottle/{id}', [BouteilleController::class, 'details'])->name('bottle.details');
Route::get('/scrape-bouteilles', [BouteilleController::class, 'scrape'])->name('bottle.scrape');
Route::get('/cellier/create', [CellierController::class, 'create'])->name('cellier.create');

// Users Routes
// Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/registration', [UserController::class, 'create'])->name('user.create');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');
// Route::get('/edit/user/{user}', [UserController::class, 'edit'])->name('user.edit');