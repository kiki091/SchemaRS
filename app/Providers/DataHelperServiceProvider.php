<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Custom\Helper\DataHelper;

class DataHelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('DataHelper', function () {
            return new DataHelper;
        });
    }
}
