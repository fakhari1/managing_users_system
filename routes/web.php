<?php

use Illuminate\Support\Facades\Route;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . "/auth.php";

Route::get('/', function () {
    $role = Role::find(1)->attachPermissions('delete users', 'delete posts');
    auth()->user()->attachRoles('admin');
    dd(auth()->user()->can('delete users', 'delete posts', 'delete images'));
});

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
