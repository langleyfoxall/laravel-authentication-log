<?php

return [
    'eventsToLog' => [
        //comment out events that should not be logged
        \Illuminate\Auth\Events\Login::class,
        \Illuminate\Auth\Events\Failed::class,
        \Illuminate\Auth\Events\Logout::class,
        \Illuminate\Auth\Events\Registered::class,
        \Illuminate\Auth\Events\Lockout::class,
        \Illuminate\Auth\Events\PasswordReset::class,
    ],
    'credentialsToOmit' => [
        //add credentials here to be ommitted from being stored in the log database
        'password',
    ],
    'fieldsToOmit' => [
        //add fields here to be omitted from being stored in the log database
        'user_ip',
    ],
    'acceptedGuards' => [
        //add guards here to specify which guards only should be accepted
        'web',
        'api',
    ],
];