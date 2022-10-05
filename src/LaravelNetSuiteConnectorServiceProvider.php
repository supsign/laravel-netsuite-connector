<?php

namespace Supsign\NetSuiteConnector;

use Illuminate\Support\ServiceProvider;

class LaravelNetSuiteConnectorServiceProvider extends ServiceProvider
{

    public function boot() 
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {

    }
}