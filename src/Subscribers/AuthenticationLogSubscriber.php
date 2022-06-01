<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Subscribers;

use LangleyFoxall\LaravelAuthenticationLog\ConfigManagers\Omissions;
use LangleyFoxall\LaravelAuthenticationLog\Models\AuthenticationLogRecord;

class AuthenticationLogSubscriber
{
    public function handleAuthenticatableLogin($event) 
    {
        self::createAuthenticationLogRecord($event);
    }

    public function handleAuthenticatableFailed($event) 
    {
        self::createAuthenticationLogRecord($event, [
            'credentials' => $event->credentials
        ]);
    }

    public function handleAuthenticatableLogout($event) 
    {
        self::createAuthenticationLogRecord($event);
    }

    public function handleAuthenticatableRegistered($event) 
    {
        self::createAuthenticationLogRecord($event);
    }

    public function handleAuthenticatableLockout($event)
    {
        self::createAuthenticationLogRecord($event, [
            'credentials' => $event->request->query(),
            'user_ip' =>  $event->request->getClientIp()
        ]);
    }
    
    public function handleAuthenticatablePasswordReset($event) 
    {   
        self::createAuthenticationLogRecord($event);
    }

    private function createAuthenticationLogRecord($event, $data = [])
    {
        $defaultParameters = [
            'eventType' => get_class($event),
            'user_ip' => request()->getClientIp(),
            'recorded_at' => now(),
        ];

        if(isset($event->user)) {
            $defaultParameters = array_merge($defaultParameters, [
                'authenticatable_id' => $event->user->id,
                'authenticatable_type' => get_class($event->user)
            ]);
        }

        if(isset($event->guard)) {
            $defaultParameters = array_merge($defaultParameters, [
                'guard' => $event->guard
            ]);
        }

        AuthenticationLogRecord::createWithConfigFilters(array_merge($defaultParameters, $data));
    }

    public function subscribe($events)
    {
        $loggableEvents = [
            \Illuminate\Auth\Events\Login::class => 'handleAuthenticatableLogin',
            \Illuminate\Auth\Events\Failed::class => 'handleAuthenticatableFailed',
            \Illuminate\Auth\Events\Logout::class => 'handleAuthenticatableLogout',
            \Illuminate\Auth\Events\Registered::class => 'handleAuthenticatableRegistered',
            \Illuminate\Auth\Events\Lockout::class => 'handleAuthenticatableLockout',
            \Illuminate\Auth\Events\PasswordReset::class => 'handleAuthenticatablePasswordReset',
        ];

        return array_filter($loggableEvents, function($key) {
            return in_array($key, config('auth-log.eventsToLog'));
        }, ARRAY_FILTER_USE_KEY);
    }
}
