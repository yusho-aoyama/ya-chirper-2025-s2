<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

// Add use lines

Route::get('/', [StaticPageController::class, 'home'])
    ->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');
});

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])
            ->name('index');

        Route::get('users', [AdminController::class, 'users'])->name('users');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/**
 * Table of the HTTP VERBs, the ENDPOINT URIs,
 * CONTROLLER ACTIONs and the ROUTEs
 * interpreted when using route('ROUTE_NAME')
 * in code.
 *
 * | Verb       |  URI                       |  Action   |  Route Name          |
 * |------------|----------------------------|-----------|----------------------|
 * | GET        |  /chirps                   |  index    |  chirps.index        |
 * | POST       |  /chirps                   |  store    |  chirps.store        |
 * | GET        |  /chirps/{chirp}/edit      |  edit     |  chirps.edit         |
 * | PUT/PATCH  |  /chirps/{chirp}           |  update   |  chirps.update       |
 * | DELETE     |  /chirps/{chirp}           |  destroy  |  chirps.destroy      |
 */



//  Laravel's router that we are looking for URIs with /chirps at the start of the URL after the domain name.
// The resource section tells the router that it is to add routes for index, show, store, create, update, edit, and delete methods in the ChirpController class
Route::resource('chirps', ChirpController::class)
    // Laravel that we are ONLY going to react to the index, store, edit, update, and destroy methods
    ->only(['index', 'store', 'edit', 'update', 'destroy',])
    // the router that the user must be authenticated and verified to be able to use these 'endpoints'.
    // ->middleware(['auth', 'verified']);
    ->middleware(['auth',]);

// Create User Resourcesful  Routes
// （index, create, store, show, edit, update, destroy)
Route::resource('users',
    UserManagementController::class)
    ->middleware(['auth',]);

// https://laravel.com/docs/12.x/routing
Route::get('users/{user}/delete', [UserManagementController::class, 'delete'])
    ->name('users.delete') // Need to change the name, 'users' is already used
    ->middleware('auth');

require __DIR__.'/auth.php';



