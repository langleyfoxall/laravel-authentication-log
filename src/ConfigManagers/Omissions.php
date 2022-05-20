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
}