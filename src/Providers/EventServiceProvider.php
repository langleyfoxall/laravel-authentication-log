<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use LangleyFoxall\LaravelAuthenticationLog\Listeners\AuthenticatableLoginListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            AuthenticatableLoginListener::class
        ]
    ];

    public function boot()
    {
        parent::boot();
    }
}