<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Tests\Feature;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Auth\Authenticatable as AuthAuthenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        $this->assertDatabaseHas('authentication_log_records', 
            ['authenticatable_id' => $user->id,
            'authenticatable_type' => get_class($user)
        ]);
    }
}