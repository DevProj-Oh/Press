<?php

namespace devprojoh\Press;

use Illuminate\Support\ServiceProvider;

class PressBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerResource();
    }

    public function register()
    {
    }

    private function registerResource()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
