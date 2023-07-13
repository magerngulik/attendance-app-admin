<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\AuthentificationController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('attendance')->group(function () {
    Route::post('/absenMasuk', [AttendancesController::class, 'absenMasuk']);
    Route::post('/absenKeluar', [AttendancesController::class, 'absenKeluar']);
    Route::get('/getAttendance/{id}', [
        AttendancesController::class,
        'getCurrentAttandace',
    ]);
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
