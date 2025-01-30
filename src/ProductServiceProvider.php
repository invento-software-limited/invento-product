<?php

namespace Invento\Product;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/product.php', 'product-config');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/product.php' => config_path('product.php')
        ], 'product-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/product')
        ], 'product-views');

        $this->publishes([
            __DIR__ . '/public' => public_path('vendor/product')
        ], 'product-assets');

        $this->publishes([
            __DIR__ . '/../resources/lang' => 'lang/vendor/product'
        ], 'product-lang');

        $this->publishes([
            __DIR__ . '/../migrations/2025_01_26_105140_create_products_table.php' => database_path('migrations/' .'2025_01_26_105140_create_products_table.php')
        ], 'product-migration');


        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'product');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'product');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/breadcrumbs.php');
    }


}