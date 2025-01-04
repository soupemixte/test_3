<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CellierBottleController;

// TODO: Remove this
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Bottles Route
Route::get('/bottles', [BouteilleController::class, 'index'])->name('bottle.index');
Route::get('/bottle/{id}', [BouteilleController::class, 'details'])->name('bottle.details');
Route::get('/scrape-bouteilles', [BouteilleController::class, 'scrape'])->name('bottle.scrape');
Route::get('/cellier/create', [CellierController::class, 'create'])->name('cellier.create');
Route::post('/bottle', [CellierBottleController::class, 'store'])->name('cellierbottle.store');
Route::get('/bottles/formulaire', [BouteilleController::class, 'form'])->name('bottle.formulaire');
Route::post('/bottles/formulaire', [BouteilleController::class, 'post'])->name('bottle.post');

// TODO: Add isAdmin Boolean in user table for authentification
// Users Routes
// Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/registration', [UserController::class, 'create'])->name('user.create');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');
// Route::get('/edit/user/{user}', [UserController::class, 'edit'])->name('user.edit');

// Auth Routes
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');