<?php


use Illuminate\Support\Facades\Route;
use Invento\Blog\Controllers\BlogController;
use Invento\Blog\Controllers\CategoryController;

Route::group(['middleware' => ['check.banned.ip','throttle:40,1','web', 'auth','permission'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['prefix' => 'blogs', 'as' => 'blogs.'], function () {

        Route::resource('categories', CategoryController::class);

        Route::resource('/', BlogController::class);
    });

});