<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ResourceController::class)->prefix('resources')->group(function ($route) {
    Route::get('/', 'getAllResources');
    Route::post('/', 'storeResource');
    Route::get('/{id}/bookings', 'getAllBookings');
});

Route::controller(BookingController::class)->prefix('bookings')->group(function () {
    Route::post('/', 'storeBooking');
    Route::delete('/{id}', 'cancelBooking');
});
