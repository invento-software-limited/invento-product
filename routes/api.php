<?php

use Invento\Product\Controllers\ProductController;
use Invento\Product\Controllers\ProductCategoryController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
    Route::get('products', [ProductController::class, 'apiIndex']);
    Route::get('products/{id}', [ProductController::class, 'apiShow']);
    Route::get('products/categories', [ProductCategoryController::class, 'apiIndex']);
    });
});

