<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Models;

use Illuminate\Database\Eloquent\Model;

class AuthenticationLogRecord extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function authenticatable()
    {
        return $this->morphTo();
    }
}