<?php


use Illuminate\Support\Facades\Route;
use Invento\Blog\Controllers\BlogController;
use Invento\Blog\Controllers\CategoryController;

Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['prefix' => 'blogs', 'as' => 'blogs.'], function () {
        Route::post('blog-categories/active/{blogCategory}', [CategoryController::class, 'activeCategory'])->name('blog-categories.active');
        Route::post('active/{blog}', [BlogController::class, 'activeBlog'])->name('active');

        Route::resource('blog-categories', CategoryController::class);

        Route::resource('/', BlogController::class);
    });

});