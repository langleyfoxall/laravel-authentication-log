<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Subscribers;

use LangleyFoxall\LaravelAuthenticationLog\ConfigManagers\Omissions;
use LangleyFoxall\LaravelAuthenticationLog\Models\AuthenticationLogRecord;

class AuthenticationLogSubscriber
{
    public function handleAuthenticatableLogin($event) 
    {
        $fields = [
            'authenticatable_id' => $event->user->id,
            'authenticatable_type' => get_class($event->user),
            'eventType' => get_class($event),
            'user_ip' => request()->getClientIp(),
            'recorded_at' => now()
        ];
        
        AuthenticationLogRecord::create(Omissions::omitFields($fields));
    }

    public function handleAuthenticatableFailed($event) 
    {
        AuthenticationLogRecord::create([
            'credentials' => Omissions::omitCredentials($event->credentials),
            'eventType' => get_class($event),
            'user_ip' => request()->getClientIp(),
            'recorded_at' => now()
        ]);
    }

    public function handleAuthenticatableLogout($event) 
    {
        AuthenticationLogRecord::create([
            'authenticatable_id' => $event->user->id,
            'authenticatable_type' => get_class($event->user),
            'eventType' => get_class($event),
            'user_ip' => request()->getClientIp(),
            'recorded_at' => now()
        ]);
    }

    public function handleAuthenticatableRegistered($event) 
    {
        AuthenticationLogRecord::create([
            'authenticatable_id' => $event->user->id,
            'authenticatable_type' => get_class($event->user),
            'eventType' => get_class($event),
            'user_ip' => request()->getClientIp(),
            'recorded_at' => now(),
        ]);
    }
    public function handleAuthenticatableLockout($event)
    {
        AuthenticationLogRecord::create([
            'credentials' => Omissions::omitCredentials($event->request->query()),
            'eventType' => get_class($event),
            'user_ip' =>  $event->request->getClientIp,
            'recorded_at' => now(),
        ]);
    }
    
    public function handleAuthenticatablePasswordReset($event) 
    {   
        AuthenticationLogRecord::create([
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
