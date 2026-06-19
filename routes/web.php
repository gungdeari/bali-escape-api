<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Travel API is running'
    ]);
});

require __DIR__.'/settings.php';
