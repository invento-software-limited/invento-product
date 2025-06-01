<?php

use Invento\Product\Controllers\ProductController;
use Invento\Product\Controllers\ProductCategoryController;
use Illuminate\Support\Facades\Route;


Route::prefix('api/v1')->group(function () {
    Route::group(function () {
        Route::get('products', [ProductController::class, 'apiIndex']);
        Route::get('products/categories', [ProductCategoryController::class, 'apiIndex']); // This should come before the {id} route
        Route::get('products/{product}', [ProductController::class, 'apiShow']); // Changed to use route model binding
    });
});

