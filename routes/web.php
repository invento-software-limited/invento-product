<?php


use Illuminate\Support\Facades\Route;
use Invento\Doctor\Controllers\ProductController;
use Invento\Doctor\Controllers\CategoryController;
use Invento\Doctor\Controllers\ConfigController;

Route::group(['middleware' => ['check.banned.ip','throttle:40,1','web', 'auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['prefix' => 'doctors', 'as' => 'doctors.'], function () {
        Route::resource('departments', CategoryController::class);
    });

    Route::get('packages/config-doctor',[ConfigController::class,'index'])->name('packages.config-doctor');
    Route::post('packages/doctor-store',[ConfigController::class,'store'])->name('packages.doctor.store');

    Route::resource('doctors', ProductController::class);

});