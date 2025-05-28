<?php


use Illuminate\Support\Facades\Route;
use Invento\Product\Controllers\ProductController;
use Invento\Product\Controllers\ProductCategoryController;
use Invento\Product\Controllers\ConfigController;

Route::group(['middleware' => ['check.banned.ip','throttle:40,1','web', 'auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::resource('categories', ProductCategoryController::class);
    });

    Route::get('packages/config-product',[ConfigController::class,'index'])->name('packages.config-product');
    Route::post('packages/product-store',[ConfigController::class,'store'])->name('packages.product.store');

    Route::resource('products', ProductController::class);

});