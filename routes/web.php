<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;

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
// chirps に対して「一覧取得と投稿だけ許可し、認証済みユーザーのみがアクセスできるルート」を設定
//  Laravel's router that we are looking for URIs with /chirps at the start of the URL after the domain name.
// The resource section tells the router that it is to add routes for index, show, store, create, update, edit, and delete methods in the ChirpController class
Route::resource('chirps', ChirpController::class)
    // Laravel that we are ONLY going to react to the index and store methods
    ->only(['index', 'store'])
    // the router that the user must be authenticated and verified to be able to use these 'endpoints'.
    // ->middleware(['auth', 'verified']);
    ->middleware(['auth',]);
/**
 * These lines have added the following routes:
 *
 * | Verb | URI       | Action | Route Name   |
 * | ---- | --------- | ------ | ------------ |
 * | GET  | '/chirps' | index  | chirps.index |
 * | POST | '/chirps' | store  | chirps.store |
 *
 *
 * ### Adding the Chirp Controller Use Line
 *
 * Go to the top of the web routes file and add the following line below the other `use` lines:
 */




require __DIR__.'/auth.php';
