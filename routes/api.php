<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendancesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('attendance')->group(function () {
    // Route::get('day/{id}', [AttendancesController::class, 'index']);
    Route::post('/absenMasuk', [AttendancesController::class, 'absenMasuk']);
    Route::post('/absenKeluar', [AttendancesController::class, 'absenKeluar']);
    Route::get('/getAttendance/{id}', [
        AttendancesController::class,
        'getCurrentAttandace',
    ]);
});
