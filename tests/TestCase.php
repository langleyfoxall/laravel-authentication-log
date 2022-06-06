<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Tests;

use LangleyFoxall\LaravelAuthenticationLog\LaravelAuthenticationLogServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // ensure default values are cleared for testing
        app('config')["auth-log.acceptedGuards"] = [];
        app('config')["auth-log.fieldsToOmit"] = [];
        app('config')["auth-log.credentialsToOmit"] = [];
        app('config')["auth-log.credentialsToEncrypt"] = [];
    }
    
    protected function getPackageProviders($app)
    {
        return [
            LaravelAuthenticationLogServiceProvider::class
        ];
    }
    
    protected function getEnvironmentSetUp($app)
    {
        
    }
}
