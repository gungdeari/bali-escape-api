<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\PaymentApiController;
use App\Http\Controllers\Api\ReviewApiController;

Route::prefix('v1/user')
    ->middleware(['auth:sanctum'])
    ->as('user.')
    ->group(function () {

        Route::apiResource('bookings', BookingApiController::class)
            ->only(['index', 'store', 'show']);
        
        Route::apiResource('payments', PaymentApiController::class)
            ->only(['index', 'show', 'store']);

        Route::get('payments/{payment}/invoice', [PaymentApiController::class, 'invoice'])
            ->name('payments.invoice');

        // nested resource — explicit routes
        Route::post('travel-packages/{packageId}/reviews', [ReviewApiController::class, 'store'])
            ->name('reviews.store');

        Route::delete('travel-packages/{packageId}/reviews', [ReviewApiController::class, 'destroy'])
            ->name('reviews.destroy');
    });