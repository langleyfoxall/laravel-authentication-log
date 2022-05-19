<?php

return [
    'eventsToLog' => [
        //comment out events that should not be logged
        Illuminate\Auth\Events\Login::class => 'handleAuthenticatableLogin',
        Illuminate\Auth\Events\Failed::class => 'handleAuthenticatableFailed',
        Illuminate\Auth\Events\Logout::class => 'handleAuthenticatableLogout'
    ],
    'credentialsToOmit' => [
        'password',
        //add credentials here to be ommitted from being stored in the log database
    ]
];