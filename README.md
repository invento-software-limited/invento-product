# Laravel Invento Doctor module

Compatible  with only Laravel multi-purpose CMS



1. Install the package via Composer:

    ```sh
     composer require invento/doctor
    ```

   The package will automatically register its service provider.

2. Optionally, publish the configuration file if you want to change any defaults:

    ```sh
    php artisan vendor:publish --provider="Invento\Doctor\DoctorServiceProvider"
    ```


## You can publish separately

1. Publish the configuration file if you want to change any defaults:

    ```sh
    php artisan vendor:publish --provider="Invento\Doctor\DoctorServiceProvider" --tag="doctor-config"
    ```

2. Publish the view file if you want to change any defaults:

    ```sh
    php artisan vendor:publish --provider="Invento\Doctor\DoctorServiceProvider" --tag="doctor-views"
    ```


3. Publish the lang file if you want to change any defaults:

    ```sh
    php artisan vendor:publish --provider="Invento\Doctor\DoctorServiceProvider" --tag="doctor-lang"
    ```

4. Publish the migration file if you want to change any defaults:

    ```sh
    php artisan vendor:publish --provider="Invento\Doctor\DoctorServiceProvider" --tag="doctor-migration"
    ```


5. At last clear cache and run autoload:

    ```sh
   php artisan optimize
   composer dump-autoload
    ```


## Copyright and License

[invento-socialite](https://bitbucket.org/zia_invento/invento-socialite/src/master/)
was written by [Awlad Hossain] and is released under the
[MIT License](LICENSE.md).

Copyright (c) 2025 Invento
