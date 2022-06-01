<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Tests\Feature;

use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use LangleyFoxall\LaravelAuthenticationLog\Models\AuthenticationLogRecord;
use LangleyFoxall\LaravelAuthenticationLog\Tests\Models\User;
use LangleyFoxall\LaravelAuthenticationLog\Tests\TestCase;

class AuthenticationLogRecordGuardsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_login_event_with_a_custom_guard_is_recorded()
    {
        $user = new User;

        $guard = 'Stop you violated the law';

        app('config')["auth-log.acceptedGuards"] = [$guard];
        
        $event = new Login($guard, $user, false);
        Event::dispatch($event);

        $this->assertDatabaseHas('authentication_log_records', [
            'authenticatable_id' => $user->id,
            'authenticatable_type' => get_class($user),
            'guard' => $guard
        ]);
    }

    public function test_a_failed_event_with_a_custom_guard_is_recorded()
    {
        $credentials = [
            'name' => "Thats not my name"
        ];

        $guard = 'Stop you violated the law';
        
        app('config')["auth-log.acceptedGuards"] = [$guard];

        $event = new Failed($guard, null, $credentials);
        Event::dispatch($event);

        $this->assertDatabaseHas('authentication_log_records', [
            'credentials' => json_encode($credentials),
            'guard' => $guard,
        ]);
    }

    public function test_a_logout_event_with_a_custom_guard_is_recorded()
    {
        $user = new User;
        
        $guard = 'Stop you violated the law';

        app('config')["auth-log.acceptedGuards"] = [$guard];

        $event = new Logout($guard, $user);
        Event::dispatch($event);

        $this->assertDatabaseHas('authentication_log_records', [
            'authenticatable_id' => $user->id,
            'authenticatable_type' => get_class($user),
            'guard' => $guard
        ]);
    }

    public function test_only_events_with_a_guard_specified_in_the_config_file_is_logged()
    {
        $user = new User;
        $acceptedGuard = 'Stop you violated the law';

        app('config')["auth-log.acceptedGuards"] = [];

        $event = new Login($acceptedGuard, $user, false);
        Event::dispatch($event);

        $this->assertDatabaseMissing('authentication_log_records', [
            'authenticatable_id' => $user->id,
            'authenticatable_type' => get_class($user),
            'guard' => $acceptedGuard,
        ]);

        app('config')["auth-log.acceptedGuards"] = [$acceptedGuard];

        $event = new Login($acceptedGuard, $user, false);
        Event::dispatch($event);

        $this->assertDatabaseHas('authentication_log_records', [
            'authenticatable_id' => $user->id,
            'authenticatable_type' => get_class($user),
            'guard' => $acceptedGuard,
        ]);
    }

    public function test_specifying_no_guards_within_config_file_allows_all_guards_to_be_logged()
    {
        $user = new User;
        $guard1 = "Guard One";
        $guard2 = "Guard Two";

        app('config')["auth-log.acceptedGuards"] = [];

        $event = new Login($guard1, $user, false);
        Event::dispatch($event);

        $event = new Login($guard2, $user, false);
        Event::dispatch($event);

        $this->assertDatabaseHas('authentication_log_records', [
            'authenticatable_id' => $user->id,
            'authentictable_type' => get_class($user),
            'guard' => $guard1 
        ]);

        $this->assertDatabaseHas('authentication_log_records', [
            'authenticatable_id' => $user->id,
            'authentictable_type' => get_class($user),
            'guard' => $guard2
        ]);
    }
}