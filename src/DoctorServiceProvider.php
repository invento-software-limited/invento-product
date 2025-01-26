<?php

namespace Invento\Doctor;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class DoctorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/doctor.php', 'doctor-config');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/doctor.php' => config_path('doctor.php')
        ], 'doctor-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/doctor')
        ], 'doctor-views');

        $this->publishes([
            __DIR__ . '/public' => public_path('vendor/doctor')
        ], 'doctor-assets');

        $this->publishes([
            __DIR__ . '/../resources/lang' => lang_path('vendor/doctor')
        ], 'doctor-lang');

        $this->publishes([
            __DIR__ . '/../migrations/2025_01_21_105140_create_doctors_table.php' => database_path('migrations/' .'2025_01_21_105140_create_doctors_table.php')
        ], 'doctor-migration');


        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'doctor');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'doctor');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/breadcrumbs.php');
    }


}