<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Tests\Feature;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\Authenticatable as AuthAuthenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use LangleyFoxall\LaravelAuthenticationLog\Tests\TestCase;
use LangleyFoxall\LaravelAuthenticationLog\Models\AuthenticationLogRecord;
use LangleyFoxall\LaravelAuthenticationLog\Subscribers\AuthenticationLogSubscriber;
use LangleyFoxall\LaravelAuthenticationLog\Tests\Models\User;
use Orchestra\Testbench\Factories\UserFactory;

class AuthenticationLogSubscriberTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
    }

    public function test_a_log_record_is_created_when_a_login_event_is_fired()
    {
        $user = new User;
        $user->id = 1;

        $event = new Login('web', $user, false);

        Event::dispatch($event);

        $this->assertDatabaseHas('authentication_log_records', [
            'authenticatable_id' => $user->id,
            'authenticatable_type' => get_class($user),
            'eventType' => get_class($event)
        ]);
    }

    public function test_a_log_record_is_created_when_a_logout_event_is_fired()
    {
        $user = new User;
        $user->id = 1;

        $event = new Logout('web', $user);

        Event::dispatch($event);

        $this->assertDatabaseHas('authentication_log_records', [
            'authenticatable_id' => $user->id,
            'authenticatable_type' => get_class($user),
            'eventType' => get_class($event)
        ]);
    }

    public function test_a_log_record_is_created_when_a_failed_event_is_fired()
    {
        $credentials = [
            'name' => 'notJohn',
        ];

        $event = new Failed('web', null, $credentials);

        Event::dispatch($event);

        $this->assertDatabaseHas('authentication_log_records', [
            'credentials' => json_encode($credentials),
            'eventType' => get_class($event)
        ]);
    }

    public function test_a_log_record_is_created_when_a_registered_event_is_fired()
    {
        $user = new User;
        $event = new Registered($user);

        Event::dispatch($event);

        $this->assertDatabaseHas('authentication_log_records', [
            'authenticatable_id' => $user->id,
            'authenticatable_type' => get_class($user),
            'eventType' => get_class($event)
        ]);
    }
}