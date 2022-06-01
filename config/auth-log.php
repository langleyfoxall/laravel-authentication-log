<?php

return [
    'eventsToLog' => [
        //comment out events that should not be logged
        Illuminate\Auth\Events\Login::class => 'handleAuthenticatableLogin',
        Illuminate\Auth\Events\Failed::class => 'handleAuthenticatableFailed',
        Illuminate\Auth\Events\Logout::class => 'handleAuthenticatableLogout',
        Illuminate\Auth\Events\Registered::class => 'handleAuthenticatableRegistered',
        Illuminate\Auth\Events\Lockout::class => 'handleAuthenticatableLockout',
        Illuminate\Auth\Events\PasswordReset::class => 'handleAuthenticatablePasswordReset',
    ],
    'credentialsToOmit' => [
        // 'password',
        //add credentials here to be ommitted from being stored in the log database
    ],
    'credentialsToEncrypt' => [
        // 'password'
    ],
    'fieldsToOmit' => [
        // 'user_ip',
        //add fields here to be omitted from being stored in the log database
    ]
];