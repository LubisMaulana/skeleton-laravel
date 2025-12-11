<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'pageLogin'])->middleware('guest')->name('login');
    Route::post('login', [AuthController::class, 'login'])->middleware('guest')->name('login');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('home', function(){
        return view('home',[
            'page' => 'Home'
        ]);
    })->name('home');
});