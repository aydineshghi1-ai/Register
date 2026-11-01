<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('register', [RegistrationController::class, 'create'] )
    ->name('register');

Route::post('register', [RegistrationController::class, 'store'] )
    ->middleware('throttle:5,1')
    ->name('register.store');

Route::get('login', [LoginController::class, 'create'] )
    ->middleware('guest')
    ->name('login');

Route::post('login', [LoginController::class, 'store'] )
    ->middleware(['guest','throttle:5,1'])
    ->name('login.store');

Route::post('logout', [LoginController::class, 'destroy'] )
    ->middleware('auth')
    ->name('logout');
