<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Traits;

use LangleyFoxall\LaravelAuthenticationLog\Models\AuthenticationLogRecord;

trait HasAuthenticatable
{
    public function authenticatable()
    {
        return $this->morphMany(AuthenticationLogRecord::class, 'authenticatable');
    }
}
