<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Subscribers;

use LangleyFoxall\LaravelAuthenticationLog\Models\AuthenticationLogRecord;

class AuthenticationLogSubscriber
{
    public function handleAuthenticatableLogin($event) {

        AuthenticationLogRecord::create([
            'authenticatable_id' => $event->user->id,
            'authenticatable_type' => get_class($event->user),
            'eventType' => get_class($event),
            'recorded_at' => now()
        ]);
    }

    public function handleAuthenticatableFailed($event) {

        AuthenticationLogRecord::create([
            'eventType' => get_class($event),
            'recorded_at' => now()
        ]);
    }

    public function handleAuthenticatableLogout($event) {

        AuthenticationLogRecord::create([
            'authenticatable_id' => $event->user->id,
            'authenticatable_type' => get_class($event->user),
            'eventType' => get_class($event),
            'recorded_at' => now()
        ]);
    }

    public function subscribe($events)
    {
        return config('auth-log.eventsToLog');
    }
}
