<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::middleware([])->group(function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
    Route::post('register', [RegisterController::class, 'register'])->name('register');

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('login', [LoginController::class, 'login'])->name('login');

    Route::get('email-verification/send', [VerificationController::class, 'send'])->name('email-verification.send');
    Route::get('email-verification/verify', [VerificationController::class, 'verify'])->name('email-verification.verify');

    Route::get('forget-password', [ForgotPasswordController::class, 'showForm'])->name('forget-password.form');
    Route::post('forget-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forget-password');

    Route::get('reset-password', [ResetPasswordController::class, 'showResetForm'])->name('reset-password.form');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('reset-password');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});




