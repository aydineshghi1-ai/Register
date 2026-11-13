<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login'])
    ->name('api.login');

Route::middleware('auth:api')->get('/me', [AuthController::class, 'me'])
    ->name('api.me');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('api.logout');

Route::middleware('auth:api')->post('/refresh', [AuthController::class, 'refresh'])
    ->name('api.refresh');

Route::middleware(['auth:api', 'role:admin'])->get('/admin-test', function () {
        return response()->json([
            'message' => 'Admin access granted.',
        ]);
    });
