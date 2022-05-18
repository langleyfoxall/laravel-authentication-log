<?php

namespace LangleyFoxall\LaravelAuthenticationLog;

use Illuminate\Support\ServiceProvider;
use LangleyFoxall\LaravelAuthenticationLog\Console\ShowLog;
use LangleyFoxall\LaravelAuthenticationLog\Providers\EventServiceProvider;

class LaravelAuthenticationLogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(EventServiceProvider::class);

        if($this->app->runningInConsole()) {
            $this->commands([
                ShowLog::class
            ]);
        }
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}