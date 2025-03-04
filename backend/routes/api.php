<?php

use App\Http\Controllers\Api\WorkorderController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'expiredToken'])->group(function () {
    Route::middleware(['role:1'])->group(function () {
        Route::get('/user', function (Request $request) {
            return response()->json($request->user(), 200);
        });

        Route::prefix('workorders-pm')->group(function () {
            Route::get('/', [WorkorderController::class, 'index']);
            Route::post('/', [WorkorderController::class, 'store']);
            Route::get('/{workorder}', [WorkorderController::class, 'show']);
            Route::put('/{workorder}', [WorkorderController::class, 'update']);
            Route::delete('/{workorder}', [WorkorderController::class, 'destroy']);
        });
    });

    Route::middleware(['role:2'])->prefix('workorders-op')->group(function () {
        Route::get('/assigned', [WorkorderController::class, 'assignWorkorders']);
        Route::patch('/assigned/{workorder}', [WorkorderController::class, 'updateStatus'])->name('workorders-op.updateStatus');

        Route::get('/assigned/{workorder}/notes', [WorkorderController::class, 'getProductionNotes'])->name('workorders-op.getProductionNotes');
        Route::post('/assigned/{workorder}/notes', [WorkorderController::class, 'addProductionNote'])->name('workorders-op.addProductionNote');
    });

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
