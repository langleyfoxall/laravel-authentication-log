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
        return $guard == null || in_array($guard, config('auth-log.acceptedGuards'));
    }

    public static function encryptCredentials($credentials)
    {
        $credentialsToEncrypt = config('auth-log.credentialsToEncrypt');

        //for each of the elements in credentials
        //if credential key is equals to any of the credentialsToEncrypt values
        //encrypt them
        //return array of keys and encrypted values

        foreach ($credentials as $credential) {
            if(in_array($credential, $credentialsToEncrypt)) {
                $credential = Crypt::encrypt($credential);
            }
        }

        array_map(function($credential) use ($credentialsToEncrypt){

            if(in_array(array_keys($credential), $credentialsToEncrypt)) {
                    $credential = Crypt::encrypt($credential);
            }

            return $credential;

        }, $credentials);
    }
}
