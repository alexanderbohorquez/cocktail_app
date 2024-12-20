<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CocktailController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

// Ruta de dashboard para mostrar los cócteles
Route::middleware(['auth'])->get('/dashboard', [CocktailController::class, 'index'])->name('dashboard');

// Rutas de perfil del usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para los cócteles
    Route::get('/cocktails', [CocktailController::class, 'index'])->name('cocktails.index');
    
    // Ruta para guardar un cóctel
    Route::post('/cocktails/store', [CocktailController::class, 'store'])->name('cocktails.store');

    // Ruta para mostrar los cócteles guardados
    Route::get('/cocktails/store', [CocktailController::class, 'store'])->name('cocktails.store');
    // Ruta de los cócteles guardados (gestionados)
Route::get('/cocktails/manage', [CocktailController::class, 'manage'])->name('cocktails.store');
Route::post('/cocktails/manage', [CocktailController::class, 'store'])->name('cocktails.store');


    // Ruta para editar un cóctel
    Route::get('/cocktails/edit/{id}', [CocktailController::class, 'edit'])->name('cocktails.edit');
    Route::put('/cocktails/edit/{id}', [CocktailController::class, 'update'])->name('cocktails.update');
    
    // Ruta para eliminar un cóctel
    Route::delete('/cocktails/destroy/{id}', [CocktailController::class, 'destroy'])->name('cocktails.destroy');
    Route::get('/', function () {
        return redirect()->route('login'); // Redirige a /login
    });
});

require __DIR__.'/auth.php';
