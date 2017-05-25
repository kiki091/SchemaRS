<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SchemaRsServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\Registration', 'App\Repositories\Implementation\Registration');
        $this->app->bind('App\Repositories\Contracts\RegistrationInpatient', 'App\Repositories\Implementation\RegistrationInpatient');
        $this->app->bind('App\Repositories\Contracts\Doctor', 'App\Repositories\Implementation\Doctor');
        $this->app->bind('App\Repositories\Contracts\RoomCare', 'App\Repositories\Implementation\RoomCare');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            'App\Repositories\Contracts\Registration',
            'App\Repositories\Contracts\RegistrationInpatient',
            'App\Repositories\Contracts\Doctor',
            'App\Repositories\Contracts\RoomCare',
        );
    }

    
}