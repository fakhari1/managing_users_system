<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

require __DIR__ . "/auth.php";

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');

        Route::get('{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::patch('{user}/update', [UserController::class, 'update'])->name('users.update');

        Route::delete('{user}/delete', [UserController::class, 'destroy'])->name('users.delete');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles');

        Route::post('create', [RoleController::class, 'store'])->name('roles.store');

        Route::get('{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::patch('{role}/update', [RoleController::class, 'update'])->name('roles.update');

        Route::delete('{role}/delete', [RoleController::class, 'destroy'])->name('roles.delete');
    });
});
