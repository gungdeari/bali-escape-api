<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DestinationApiController;
use App\Http\Controllers\Api\TravelPackageApiController;
use App\Http\Controllers\Api\ReviewApiController;

Route::prefix('v1')
    ->as('public.')
    ->group(function () {

        Route::apiResource('destinations', DestinationApiController::class)
            ->only(['index', 'show']);

        Route::apiResource('travel-packages', TravelPackageApiController::class)
            ->only(['index', 'show']);

        Route::get('travel-packages/{packageId}/reviews', [ReviewApiController::class, 'index'])
            ->name('reviews.index');

    });