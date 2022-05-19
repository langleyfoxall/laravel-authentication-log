<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Subscribers;

class AuthenticationLogSubscriber
{
    public function handleAuthenticatableLogin($event) {
        dd("Do the login thing!");
    }

    public function handleAuthenticatableFailed($event) {
        dd("Do the fail thing!");
    }

    public function subscribe($events)
    {
        return config('auth-log.eventsToLog');
    }
}