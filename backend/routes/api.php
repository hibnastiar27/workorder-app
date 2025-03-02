<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'expiredToken'])->group(function () {
    Route::middleware(['role:1'])->group(function () {
        Route::get('/user', function (Request $request) {
            return response()->json($request->user(), 200);
        });
    });

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
