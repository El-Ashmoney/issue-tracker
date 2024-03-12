<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    // Home Controller
    Route::get('/', [HomeController::class, 'index'])->name('index');

    // Users Controller
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/edit_users/{id}', [UsersController::class, 'edit'])->name('edit_user');
    Route::post('/update_user/{id}', [UsersController::class, 'update'])->name('update_user');
    Route::post('/delete_user/{id}', [UsersController::class, 'destroy'])->name('delete_user');
});