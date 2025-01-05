<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BottleController;
use App\Http\Controllers\CellarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// TODO: Remove this
Route::get('/', function () {
    return view('welcome');
});

Route::get('/cellar/create', [CellarController::class, 'create'])
    ->name('cellar.create')
    ->middleware('auth');
// Bottle Route
Route::get('/bottles', [BottleController::class, 'index'])->name('bottle.index');
Route::get('/bottle/{id}', [BottleController::class, 'details'])->name('bottle.details');
Route::get('/scrape-bouteilles', [BottleController::class, 'scrape'])->name('bottle.scrape');

// Cellar Routes
Route::get('/cellars', [CellarController::class, 'index'])->name('cellar.index');
Route::get('/cellar/{cellar}', [CellarController::class, 'show'])->name('cellar.show');
Route::post('/cellar/store', [CellarController::class, 'store'])
    ->name('cellar.store')
    ->middleware('auth');
Route::get('/edit/cellar/{cellar}', [CellarController::class, 'edit'])->name('cellar.edit');
Route::put('/edit/cellar/{cellar}', [CellarController::class, 'update'])->name('cellar.update');
Route::delete('/cellar/{cellar}', [CellarController::class, 'destroy'])->name('cellar.delete');

// TODO: Add isAdmin Boolean in user table for authentification
// User Routes
// Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/registration', [UserController::class, 'create'])->name('user.create');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');
// Route::get('/edit/user/{user}', [UserController::class, 'edit'])->name('user.edit');

// Auth Routes
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');