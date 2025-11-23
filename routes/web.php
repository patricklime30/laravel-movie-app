<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    // dashboard route
    Route::get('/dashboard', [MovieController::class, 'index'])->name('dashboard');

    // movie route
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    
    //create
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
    
    //show
    Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

    //update
    Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');

    // Delete movie
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
