<?php

namespace LangleyFoxall\LaravelAuthenticationLog\ConfigManagers;

class Omissions
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
}