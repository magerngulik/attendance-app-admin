<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\AuthentificationController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('attendance')->group(function () {
    Route::post('/check_in', [AttendancesController::class, 'absenMasuk'])->middleware('auth:sanctum');
    Route::post('/check_out', [AttendancesController::class, 'absenKeluar'])->middleware('auth:sanctum');
    Route::get('/location', [AttendancesController::class, 'compareLocation'])->middleware('auth:sanctum');
    Route::get('/current', [AttendancesController::class, 'current'])->middleware('auth:sanctum');
    Route::get('/delete', [AttendancesController::class, 'delete'])->middleware('auth:sanctum');
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthentificationController::class, 'login']);
    Route::post('/register', [AuthentificationController::class, 'register']);
    Route::get('/logout', [
        AuthentificationController::class,
        'logout',
    ])->middleware('auth:sanctum');
    Route::get('/profile', [
        AuthentificationController::class,
        'me',
    ])->middleware('auth:sanctum');
});
