<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ItemController;
use App\Http\Controllers\Api\V1\RestaurantController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::controller(RestaurantController::class)->group(function () {
        Route::get('/restaurants', 'index');
        Route::get('/restaurants/{restaurant}', 'show');
        Route::post('/restaurants', 'store');
        Route::put('/restaurants/{restaurant}', 'update');
        Route::patch('/restaurants/{restaurant}', 'update');
        Route::delete('/restaurants/{restaurant}', 'destroy');
    });

    Route::controller(ItemController::class)->group(function () {
        Route::get('/items', 'index');
        Route::get('/items/{item}', 'show');
        Route::post('/items', 'store');
        Route::put('/items/{item}', 'update');
        Route::patch('/items/{item}', 'update');
        Route::delete('/items/{item}', 'destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index');
        Route::get('/categories/{category}', 'show');
        Route::post('/categories', 'store');
        Route::put('/categories/{category}', 'update');
        Route::patch('/categories/{category}', 'update');
        Route::delete('/categories/{category}', 'destroy');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/{user}', 'show');
        Route::post('/users', 'store');
        Route::put('/users/{user}', 'update');
        Route::patch('/users/{user}', 'update');
        Route::delete('/users/{user}', 'destroy');
    });
});
