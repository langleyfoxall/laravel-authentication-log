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
}
