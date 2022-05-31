<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use LangleyFoxall\LaravelAuthenticationLog\Tests\TestCase;
use LangleyFoxall\LaravelAuthenticationLog\Models\AuthenticationLogRecord;

class AuthenticationLogRecordTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_an_authenticationLogRecord_stores_it_in_a_database()
    {
        $timeLog = now();

        $attributes = [
            'authenticatable_id' => 1,
            'authenticatable_type' => "Test Type",
            'eventType' => 'testEvent',
            'recorded_at' => $timeLog
        ];

        $record = AuthenticationLogRecord::create($attributes);
        $this->assertDatabaseHas('authentication_log_records', $attributes);
    }

    public function test_creating_a_record_stores_the_ip_address_in_the_database()
    {
        $testIP = '88.123.66.99';

        $attributes = [
            'eventType' => 'testEvent',
            'recorded_at' => now(),
            'user_ip' => $testIP
        ];

        AuthenticationLogRecord::create($attributes);
        $this->assertDatabaseHas('authentication_log_records', ['user_ip' => $testIP]);
    }
}
