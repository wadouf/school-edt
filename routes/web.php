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
    
    // Classes routes - avec paramètre explicite {classe}
    Route::get('classes', [\App\Http\Controllers\ClasseController::class, 'index'])->name('classes.index');
    Route::get('classes/create', [\App\Http\Controllers\ClasseController::class, 'create'])->name('classes.create');
    Route::post('classes', [\App\Http\Controllers\ClasseController::class, 'store'])->name('classes.store');
    Route::get('classes/{classe}', [\App\Http\Controllers\ClasseController::class, 'show'])->name('classes.show');
    Route::get('classes/{classe}/edit', [\App\Http\Controllers\ClasseController::class, 'edit'])->name('classes.edit');
    Route::put('classes/{classe}', [\App\Http\Controllers\ClasseController::class, 'update'])->name('classes.update');
    Route::patch('classes/{classe}', [\App\Http\Controllers\ClasseController::class, 'update'])->name('classes.patch');
    Route::delete('classes/{classe}', [\App\Http\Controllers\ClasseController::class, 'destroy'])->name('classes.destroy');
    Route::get('classes-export', [\App\Http\Controllers\ClasseController::class, 'export'])->name('classes.export');
});

require __DIR__.'/auth.php';
