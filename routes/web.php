<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [RegistrationController::class, 'create'] )
    ->name('register');

Route::post('register', [RegistrationController::class, 'store'] )
    ->middleware('throttle:5,1')
    ->name('register.store');
