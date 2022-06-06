<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Models;

use Illuminate\Database\Eloquent\Model;
use LangleyFoxall\LaravelAuthenticationLog\Configurations\ConfigManager;

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

    private static function guardIsAccepted(array $data)
    {
        if(!array_key_exists('guard', $data)) {
            return true;
        }

        else if(ConfigManager::guardAccepted($data['guard'])) {
            return true;
        }
        
        return false;
    }

    public static function createWithConfigFilters(array $data)
    {
        if(array_key_exists('credentials', $data)) {
            $data['credentials'] = ConfigManager::omitCredentials($data['credentials']);
            $data['credentials'] = ConfigManager::encryptCredentials($data['credentials']);
        }
        self::create(ConfigManager::omitFields($data));
    }
}