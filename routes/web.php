<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BottleController;
use App\Http\Controllers\CellarBottleController;
use App\Http\Controllers\CellarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SetLocaleController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\CellierBottleController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// User Routes
Route::get('/registration', [UserController::class, 'create'])->name('user.create');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');
// Auth Routes
Route::get('/connection', [AuthController::class, 'chooseConnection'])->name('auth.connection');
Route::get('/login', [AuthController::class, 'showUserLoginForm'])->name('user.login');
Route::post('/login', [AuthController::class, 'userLogin'])->name('user.login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

//Authentification de l'administrateur avec fonctionnalités autorisées pour l'administrateur
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::middleware('auth:admin')->group(function () {
    });
});

Route::get('/bottles', [BottleController::class, 'index'])->name('bottle.index');
Route::get('/scrape-bouteilles', [BottleController::class, 'scrape'])->name('bottle.scrape');
Route::get('/scraping/stop', [BottleController::class, 'stopScraping'])->name('scraping.stop');
/**
 * Comptage des bouteilles en temps réel
 */
Route::get('/api/total-bottles', [BottleController::class, 'getTotalBottles'])->name('bottle.total_bottles');


Route::middleware('auth')->group(function () {
    // Welcome route
    Route::get('/', function () {
        return view('welcome');
    });
    // Route::get('/', [CellarController::class, 'index']);
    Route::get('/cellar/create', [CellarController::class, 'create'])->name('cellar.create');
    // Bottle Route
    Route::get('/bottle/{id}', [BottleController::class, 'details'])->name('bottle.details');

    Route::post('/bottle/{id}/add-to-cellar', [BottleController::class, 'addToCellar'])->name('bottle.addToCellar');

    //Start and stop the scrapping
    /* Route::get('/scraping/start', [BottleController::class, 'startScraping'])->name('scraping.start');
    Route::get('/scraping/stop', [BottleController::class, 'stopScraping'])->name('scraping.stop'); */


    //Delete the bottle
    Route::get('/delete', [BottleController::class, 'destroy'])->name('bottle.delete');
    // Cellar Routes
    Route::get('/cellars', [CellarController::class, 'index'])->name('cellar.index');
    Route::get('/cellar/{cellar}', [CellarController::class, 'show'])->name('cellar.show');
    Route::post('/cellar/store', [CellarController::class, 'store'])->name('cellar.store');
    Route::get('/edit/cellar/{cellar}', [CellarController::class, 'edit'])->name('cellar.edit');
    Route::put('/edit/cellar/{cellar}', [CellarController::class, 'update'])->name('cellar.update');
    Route::delete('/cellar/{cellar}', [CellarController::class, 'destroy'])->name('cellar.delete');
    Route::get('/cellar/add/{id}', [CellarController::class, 'add'])->name('cellar.add');    
    Route::post('/cellar/store-bottle', [CellarController::class, 'storeBottle'])->name('cellar.storeBottle');
    // Route::get('/cellar/ajout/{id}', [CellarController::class, 'switch'])->name('cellar.return');
    Route::post('/cellar/remove-bottle', [CellarController::class, 'removeBottle'])->name('cellar.removeBottle');
    // User Routes
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/profile/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/edit/user/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/edit/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/destroy/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});


Route::get('/lang/{locale}', [SetLocaleController::class, 'index'])->name('lang');