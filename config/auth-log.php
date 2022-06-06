<?php

return [
    'eventsToLog' => [
        //comment out events that should not be logged
        \Illuminate\Auth\Events\Failed::class,
        \Illuminate\Auth\Events\Lockout::class,
        \Illuminate\Auth\Events\Login::class,
        \Illuminate\Auth\Events\Logout::class,
        \Illuminate\Auth\Events\PasswordReset::class,
        \Illuminate\Auth\Events\Registered::class,
    ],
    'credentialsToOmit' => [
        //add credentials here to be omitted from being stored in the log database
        'password',
    ],
    'credentialsToEncrypt' => [
        //add credentials here to be encrypted in the log database, for example
        // 'password'
    ],
    'fieldsToOmit' => [
        //add fields here to be omitted from being stored in the log database, for example
        // 'user_ip',
    ],
    'acceptedGuards' => [
        //add guards here to specify which guards only should be accepted, for example,
        // 'web',
        // 'api',
    ],
];