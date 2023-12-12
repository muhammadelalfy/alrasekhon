<?php

use App\Http\Controllers\Api\Driver\V1\AuthController;
use App\Http\Controllers\Api\Driver\V1\DriverController;
use App\Http\Controllers\Api\Driver\V1\FileController;
use App\Http\Controllers\Api\Driver\V1\NotificationController;
use App\Http\Controllers\Api\Driver\V1\OrderController;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);
Route::post('otp-check', [AuthController::class, 'otpCheck']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);
Route::post('version-check', [AuthController::class, 'versionCheck']);
Route::middleware('auth:driver-api')->group(function(){
    // Profile
    Route::get('profile', [DriverController::class, 'profile']);
    Route::put('update-profile', [DriverController::class, 'updateProfile']);
    Route::put('change-status', [DriverController::class, 'changeStatus']);
    // Files
    Route::post('files', [FileController::class, 'upload']);
    // Auth
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('refresh-token', [AuthController::class, 'refreshToken']);
    // Order
    Route::group(['prefix' => 'orders'], function(){
        Route::controller(OrderController::class)->group(function () {
            Route::get('',  'index');
            Route::post('{id}/picked',  'picked');
            Route::post('{id}/delivered',  'delivered');
        });
    });
    // Notification
    Route::group(['prefix' => 'notifications'], function(){
        Route::controller(NotificationController::class)->group(function () {
            Route::get('', 'index');
        });
    });

});
