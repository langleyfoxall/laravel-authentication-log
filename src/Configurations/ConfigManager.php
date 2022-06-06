<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Configurations;

use Illuminate\Support\Facades\Crypt;

use function PHPUnit\Framework\arrayHasKey;

class ConfigManager
{
    public static function omitCredentials($credentials)
    {
        $credentialsToOmit = config('auth-log.credentialsToOmit');

        return array_filter($credentials, function($key) use($credentialsToOmit) {
            return !in_array($key, $credentialsToOmit);
        }, ARRAY_FILTER_USE_KEY);
    }

    public static function omitFields($fields)
    {
        $fieldsToOmit = config('auth-log.fieldsToOmit');

        return array_filter($fields, function($key) use($fieldsToOmit) {
            return !in_array($key, $fieldsToOmit);
        }, ARRAY_FILTER_USE_KEY);
    }

    public static function guardAccepted($guard)
    {
        return $guard == null || in_array($guard, config('auth-log.acceptedGuards'))
            || config('auth-log.acceptedGuards') == [];
    }

    public static function encryptCredentials($credentials)
    {
        $credentialsToEncrypt = config('auth-log.credentialsToEncrypt');

        array_walk($credentials, function(&$value, $key) use($credentialsToEncrypt) {
            if(in_array($key, $credentialsToEncrypt)) {
                $value = Crypt::encryptString($value);
            }
        });
        
        return $credentials;
    }
}
