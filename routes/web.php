<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'pageLogin'])->middleware('guest')->name('login');
    Route::post('login', [AuthController::class, 'login'])->middleware('guest')->name('login');
});

Route::middleware('CheckRole:OPR,SPV')->group(function () {
    Route::get('home', [AppController::class, 'home'])->name('home');
});

Route::middleware('CheckRole:SPV')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('users');
        Route::get('get-data', [UserController::class, 'getData'])->name('get.users');
        Route::get('{id}', [UserController::class, 'show'])->name('users.show');
        Route::post('add', [UserController::class, 'store'])->name('users.store');
        Route::put('edit/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});