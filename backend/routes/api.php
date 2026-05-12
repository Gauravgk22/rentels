<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Auth\Controllers\AuthController;
use App\Modules\Property\Controllers\PropertyController;
use App\Modules\Vehicle\Controllers\VehicleController;
use App\Modules\Booking\Controllers\BookingController;
use App\Modules\Wallet\Controllers\WalletController;
use App\Modules\Vehicle\Controllers\GpsController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('properties', PropertyController::class);
    Route::apiResource('vehicles', VehicleController::class);
    Route::post('bookings', [BookingController::class, 'store']);

    Route::get('wallet/balance', [WalletController::class, 'balance']);
    Route::post('wallet/deposit', [WalletController::class, 'deposit']);

    Route::post('vehicles/{id}/gps', [GpsController::class, 'update']);
    Route::get('vehicles/{id}/gps/history', [GpsController::class, 'history']);
});
