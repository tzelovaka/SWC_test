<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::get('/resources', [ResourceController::class, 'index']);
    Route::post('/resources', [ResourceController::class, 'post']);
    Route::post('/bookings', [BookingController::class, 'post']);
    Route::delete('/bookings/{id}', [BookingController::class, 'delete']);
    Route::get('/resources/{id}/bookings', [IndexController::class, 'index']);
});


