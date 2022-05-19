<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use LangleyFoxall\LaravelAuthenticationLog\Listeners\AuthenticatableLoginListener;
use LangleyFoxall\LaravelAuthenticationLog\Subscribers\AuthenticationLogSubscriber;

class EventServiceProvider extends ServiceProvider
{
    protected $subscribe = [
        AuthenticationLogSubscriber::class
    ];

    public function boot()
    {
        parent::boot();

        
    }
}