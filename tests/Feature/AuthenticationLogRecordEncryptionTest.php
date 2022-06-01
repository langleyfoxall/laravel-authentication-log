<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Tests\Feature;

use Illuminate\Auth\Events\Failed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Event;
use LangleyFoxall\LaravelAuthenticationLog\Models\AuthenticationLogRecord;
use LangleyFoxall\LaravelAuthenticationLog\Tests\Models\User;
use LangleyFoxall\LaravelAuthenticationLog\Tests\TestCase;

class AuthenticationLogRecordEncryptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_adding_a_credential_to_encrypt_stores_the_encypted_data()
    {
        $credentials = [
            'name' => "They call me Stacy",
            'password' => "This should be encrypted",
        ];

        app('config')["auth-log.credentialsToEncrypt"] = [];

        $event = new Failed(null, null, $credentials);
        Event::dispatch($event);

        $this->assertEquals(AuthenticationLogRecord::first()->credentials, $credentials);

        AuthenticationLogRecord::first()->delete();

        app('config')["auth-log.credentialsToEncrypt"] = ['password'];

        $event = new Failed(null, null, $credentials);
        Event::dispatch($event);

        $this->assertNotEquals(AuthenticationLogRecord::first()->credentials, $credentials);
        $this->assertEquals(Crypt::decryptString(AuthenticationLogRecord::first()->credentials["password"]), "This should be encrypted");
    }

    public function test_adding_a_credential_to_both_omit_and_encrypt_omits_the_data_entirely()
    {
        $credentials = [
            'name' => "They call me Stacy",
            'password' => "This should be encrypted",
        ];

        app('config')["auth-log.credentialsToEncrypt"] = ['password'];
        app('config')["auth-log.credentialsToOmit"] = ['password'];

        $event = new Failed(null, null, $credentials);
        Event::dispatch($event);

        $this->assertEquals(AuthenticationLogRecord::first()->credentials, ['name' => "They call me Stacy"]);
        $this->assertNotEquals(AuthenticationLogRecord::first()->credentials, $credentials);
    }

    public function test_adding_a_credential_that_does_not_exist_does_not_cause_errors()
    {
        $credentials = [
            'name' => "They call me Hell",
            'password' => "Some password",
        ];

        app('config')["auth-log.credentialsToEncrypt"] = ['Definitely not a credential'];

        $event = new Failed(null, null, $credentials);
        Event::dispatch($event);

        $this->assertDatabaseHas('authentication_log_records', ["credentials" => json_encode($credentials)]);
    }

    public function test_no_specified_credentials_to_encrypt_does_not_encrypt_any_credentials()
    {
        $credentials = [
            'name' => 'notJohn',
            'password' => "This should still be here"
        ];

        app('config')["auth-log.credentialsToEncrypt"] = [];

        $event = new Failed(null, null, $credentials);
        Event::dispatch($event);

        $this->assertDatabaseHas('authentication_log_records', [
            'credentials' => json_encode($credentials),
        ]);
    }
}