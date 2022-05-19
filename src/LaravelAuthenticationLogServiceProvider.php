<?php

namespace LangleyFoxall\LaravelAuthenticationLog;

use AuthenticatableListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use LangleyFoxall\LaravelAuthenticationLog\Console\ShowLog;
use LangleyFoxall\LaravelAuthenticationLog\Listeners\AuthenticatableLoginListener;
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

        $this->mergeConfigFrom(__DIR__.'/../config/auth-log.php', 'auth-log');
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}