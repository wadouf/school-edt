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
    
    // Salles routes - avec paramètre explicite {salle}
    Route::get('salles', [\App\Http\Controllers\SalleController::class, 'index'])->name('salles.index');
    Route::get('salles/create', [\App\Http\Controllers\SalleController::class, 'create'])->name('salles.create');
    Route::post('salles', [\App\Http\Controllers\SalleController::class, 'store'])->name('salles.store');
    Route::get('salles/{salle}', [\App\Http\Controllers\SalleController::class, 'show'])->name('salles.show');
    Route::get('salles/{salle}/edit', [\App\Http\Controllers\SalleController::class, 'edit'])->name('salles.edit');
    Route::put('salles/{salle}', [\App\Http\Controllers\SalleController::class, 'update'])->name('salles.update');
    Route::patch('salles/{salle}', [\App\Http\Controllers\SalleController::class, 'update'])->name('salles.patch');
    Route::delete('salles/{salle}', [\App\Http\Controllers\SalleController::class, 'destroy'])->name('salles.destroy');
    Route::get('salles-export', [\App\Http\Controllers\SalleController::class, 'export'])->name('salles.export');
});

require __DIR__.'/auth.php';
