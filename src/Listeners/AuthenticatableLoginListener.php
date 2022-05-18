<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use LangleyFoxall\LaravelAuthenticationLog\Models\AuthenticationLogRecord;

class AuthenticatableLoginListener
{
    public function handle(Login $event)
    {
        AuthenticationLogRecord::create([
            'authenticatable_id' => Auth::id(),
            'authenticatable_type' => get_class(Auth::user()),
            'recorded_at' => now()
        ]);
    }
}
