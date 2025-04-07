<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::controller(RestaurantController::class)->group(function () {
        Route::get('restaurants', 'index');
        Route::get('/restaurants/{restaurant}', 'show');
    });
});
