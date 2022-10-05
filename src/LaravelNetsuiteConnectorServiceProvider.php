<?php

namespace Supsign\NetsuiteConnector;

use Illuminate\Support\ServiceProvider;

class LaravelNetsuiteConnectorServiceProvider extends ServiceProvider
{

    public function boot() 
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register()
    {

    }
}