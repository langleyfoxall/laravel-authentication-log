<?php

namespace LangleyFoxall\LaravelAuthenticationLog\ConfigManagers;

class Omissions
{
    public static function omitCredentials($credentials)
    {
        $credentialsToOmit = config('auth-log.credentialsToOmit');

        if ($credentialsToOmit == []) {
            return $credentials;
        } else {
            return array_diff_key($credentials, array_flip($credentialsToOmit));
        }
    }
}