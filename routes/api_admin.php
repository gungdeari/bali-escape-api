<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DestinationApiController;
use App\Http\Controllers\Api\TravelPackageApiController;
use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\PaymentApiController;


Route::prefix('v1/admin')
    ->middleware(['auth:sanctum', 'role:admin'])
    ->as('admin.')
    ->group(function () {

        // Destination
        Route::apiResource('destinations', DestinationApiController::class)
            ->except(['index', 'show', 'update'])
            ->parameters(['destinations' => 'destination']);

        Route::patch('destinations/{destination}', [DestinationApiController::class, 'update'])
            ->name('admin.destinations.update');

        // Travel Package
        Route::apiResource('travel-packages', TravelPackageApiController::class)
            ->except(['index', 'show', 'update']);

        Route::patch('travel-packages/{travel_package}', [TravelPackageApiController::class, 'update'])
            ->name('admin.travel-packages.update');

        // Booking Management
        Route::apiResource('bookings', BookingApiController::class)
            ->only(['index', 'show']);

        Route::patch('bookings/{booking}/status', [BookingApiController::class, 'updateStatus'])
            ->name('bookings.update-status');
        
        Route::apiResource('payments', PaymentApiController::class)
            ->only(['index', 'show']);
    });