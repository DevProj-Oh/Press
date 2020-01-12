<?php

namespace devprojoh\Press;

use devprojoh\Press\Console\ProcessCommand;
use Illuminate\Support\ServiceProvider;

class PressBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        $this->registerResource();
    }

    public function register()
    {
        $this->commands([
            ProcessCommand::class,
        ]);
    }

    private function registerResource()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/press.php' => config_path('press.php'),
        ], 'press-config');
    }
}
