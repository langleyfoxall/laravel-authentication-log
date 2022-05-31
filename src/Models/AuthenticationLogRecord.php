<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Models;

use Illuminate\Database\Eloquent\Model;
use LangleyFoxall\LaravelAuthenticationLog\ConfigManagers\Omissions;

class AuthenticationLogRecord extends Model
{
    protected $guarded = [];

    protected $casts = [
        'credentials' => 'array'
    ];

    public $timestamps = false;

    public function authenticatable()
    {
        return $this->morphTo();
    }

    public static function createWithOmissions(array $data)
    {
        if(array_key_exists('credentials', $data)) {
            $data['credentials'] = Omissions::omitCredentials($data['credentials']);
        }
        self::create(Omissions::omitFields($data));
    }
}