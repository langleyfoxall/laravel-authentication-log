<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Subscribers;

use LangleyFoxall\LaravelAuthenticationLog\ConfigManagers\Omissions;
use LangleyFoxall\LaravelAuthenticationLog\Models\AuthenticationLogRecord;

class AuthenticationLogSubscriber
{
    // TODO pulled from master, watch out for merge conflict errors
    public function handleAuthenticatableLogin($event) 
    {
        AuthenticationLogRecord::createWithConfigFilters([
            'authenticatable_id' => $event->user->id,
            'authenticatable_type' => get_class($event->user),
            'eventType' => get_class($event),
            'user_ip' => request()->getClientIp(),
            'guard' => $event->guard, 
            'recorded_at' => now()
        ]);
    }

    public function handleAuthenticatableFailed($event) 
    {
        AuthenticationLogRecord::createWithConfigFilters([
            'credentials' => $event->credentials,
            'eventType' => get_class($event),
            'user_ip' => request()->getClientIp(),
            'guard' => $event->guard,
            'recorded_at' => now()
        ]);
    }

    public function handleAuthenticatableLogout($event) 
    {
        AuthenticationLogRecord::createWithConfigFilters([
            'authenticatable_id' => $event->user->id,
            'authenticatable_type' => get_class($event->user),
            'eventType' => get_class($event),
            'user_ip' => request()->getClientIp(),
            'guard' => $event->guard,
            'recorded_at' => now()
        ]);
    }

    public function handleAuthenticatableRegistered($event) 
    {
        AuthenticationLogRecord::createWithConfigFilters([
            'authenticatable_id' => $event->user->id,
            'authenticatable_type' => get_class($event->user),
            'eventType' => get_class($event),
            'user_ip' => request()->getClientIp(),
            'recorded_at' => now(),
        ]);
    }

    public function handleAuthenticatableLockout($event)
    {
        AuthenticationLogRecord::createWithConfigFilters([
            'credentials' => $event->request->query(),
            'eventType' => get_class($event),
            'user_ip' =>  $event->request->getClientIp(),
            'recorded_at' => now(),
        ]);
    }
    
    public function handleAuthenticatablePasswordReset($event) 
    {   
        AuthenticationLogRecord::createWithConfigFilters([
                'authenticatable_id' => $event->user->id,
                'authenticatable_type' => get_class($event->user),
                'eventType' => get_class($event),
                'user_ip' => request()->getClientIp(),
                'recorded_at' => now(),
            ]);
    }

    public function subscribe($events)
    {
        return config('auth-log.eventsToLog');
    }
}
