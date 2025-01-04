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

// Bottle Route
Route::get('/bottles', [BottleControllerr::class, 'index'])->name('bottle.index');
Route::get('/bottle/{id}', [BottleController::class, 'details'])->name('bottle.details');
Route::get('/scrape-bouteilles', [BottleController::class, 'scrape'])->name('bottle.scrape');

// Cellar Routes
Route::get('/cellar/index', [CellarController::class, 'index'])->name('cellar.index');
Route::get('/cellar/create', [CellarController::class, 'create'])->name('cellar.create');

// TODO: Add isAdmin Boolean in user table for authentification
// User Routes
// Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/registration', [UserController::class, 'create'])->name('user.create');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');
// Route::get('/edit/user/{user}', [UserController::class, 'edit'])->name('user.edit');

// Auth Routes
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');