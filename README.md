# Laravel Invento Doctor module

Compatible  with only Laravel multi-purpose CMS



1. Install the package via Composer:

    ```sh
     composer require invento/product
    ```

   The package will automatically register its service provider.

2. Optionally, publish the configuration file if you want to change any defaults:

    ```sh
    php artisan vendor:publish --provider="Invento\Product\ProductServiceProvider"
    ```


## You can publish separately

1. Publish the configuration file if you want to change any defaults:

    ```sh
    php artisan vendor:publish --provider="Invento\Product\ProductServiceProvider" --tag="product-config"
    ```

2. Publish the view file if you want to change any defaults:

    ```sh
    php artisan vendor:publish --provider="Invento\Product\ProductServiceProvider" --tag="product-views"
    ```


3. Publish the lang file if you want to change any defaults:

    ```sh
    php artisan vendor:publish --provider="Invento\Product\ProductServiceProvider" --tag="product-lang"
    ```

4. Publish the asset file if you want to change any defaults:

    ```sh
    php artisan vendor:publish --provider="Invento\Product\ProductServiceProvider" --tag="product-assets"
    ```
   
5. Publish the migration file if you want to change any defaults:

    ```sh
    php artisan vendor:publish --provider="Invento\Product\ProductServiceProvider" --tag="product-migration"
    ```


6. At last clear cache and run autoload:

    ```sh
   php artisan optimize
   composer dump-autoload
    ```


## Copyright and License

[invento-socialite](https://bitbucket.org/zia_invento/invento-socialite/src/master/)
was written by [Awlad Hossain] and is released under the
[MIT License](LICENSE.md).

Copyright (c) 2025 Invento
