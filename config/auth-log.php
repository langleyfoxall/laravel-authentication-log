<?php

return [
    'eventsToLog' => [
        Illuminate\Auth\Events\Login::class => 'handleAuthenticatableLogin',
        Illuminate\Auth\Events\Failed::class => 'handleAuthenticatableFailed',
    ],
    // TODO credentialsToOmit will be read, any credentials specified here will not be stored in the log
    'credentialsToOmit' => [
        'password'
    ]
];