<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Ruta para mostrar el formulario de registro
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    
    // Ruta para procesar el registro
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Ruta para mostrar el formulario de login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // Ruta para procesar el login
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Rutas para el restablecimiento de contraseña
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    // Rutas de verificación de email
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Ruta para confirmar contraseña
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Ruta para actualizar la contraseña
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Ruta para cerrar sesión
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
