<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Si l'utilisateur est déjà connecté, rediriger vers le dashboard
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    // Sinon, rediriger vers la page de connexion
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Classes routes
    Route::resource('classes', \App\Http\Controllers\ClasseController::class);
    Route::get('classes-export', [\App\Http\Controllers\ClasseController::class, 'export'])->name('classes.export');
});

require __DIR__.'/auth.php';
