<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Traits;

use LangleyFoxall\LaravelAuthenticationLog\Models\AuthenticationLogRecord;

trait HasAuthenticatable
{
    public function authenticationLogRecords()
    {
        return $this->morphMany(AuthenticationLogRecord::class, 'authenticationLogRecord');
    }
}