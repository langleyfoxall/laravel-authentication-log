<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Tests\Feature;

use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use LangleyFoxall\LaravelAuthenticationLog\Models\AuthenticationLogRecord;
use LangleyFoxall\LaravelAuthenticationLog\Tests\Models\User;
use LangleyFoxall\LaravelAuthenticationLog\Tests\TestCase;

class AuthenticationLogRecordOmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_omitting_credentials_from_the_config_file_does_not_include_them_in_the_records()
    {
        $testName = "bajfnk";
        $credentials = [
            'name' => $testName,
            'thingToOmit' => "12345678",
        ];

        app('config')["auth-log.credentialsToOmit"] = [];

        $event = new Failed(null, null, $credentials);
        Event::dispatch($event);

        $this->assertEquals(AuthenticationLogRecord::first()->credentials, $credentials);

        AuthenticationLogRecord::first()->delete();

        app('config')["auth-log.credentialsToOmit"] = ['thingToOmit'];

        $event = new Failed(null, null, $credentials);
        Event::dispatch($event);

        $this->assertEquals(AuthenticationLogRecord::first()->credentials, ['name' => $testName]);
    }

    public function test_omitting_ip_address_from_the_config_file_does_not_include_it_in_the_record()
    {
        $user = new User;

        app('config')["auth-log.fieldsToOmit"] = [];

        $event = new Login(null, $user, false);
        Event::dispatch($event);

        $this->assertNotNull(AuthenticationLogRecord::first()->user_ip);

        AuthenticationLogRecord::first()->delete();

        app('config')["auth-log.fieldsToOmit"] = ['user_ip'];

        $event = new Login(null, $user, false);
        Event::dispatch($event);

        $this->assertNull(AuthenticationLogRecord::first()->user_ip);
    }
}
