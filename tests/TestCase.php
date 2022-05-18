<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Tests;

use LangleyFoxall\LaravelAuthenticationLog\LaravelAuthenticationLogServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
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
