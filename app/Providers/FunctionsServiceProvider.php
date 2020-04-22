<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FunctionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        require app_path('includes/functions.php');
    }
}
