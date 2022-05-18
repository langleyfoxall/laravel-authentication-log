<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Console;

use Illuminate\Console\Command;
use LangleyFoxall\LaravelAuthenticationLog\Models\AuthenticationLogRecord;

class ShowLog extends Command
{
    protected $signature = 'laravel-authentication-log:showlog';
    protected $description = 'Presents all data stored within the Authentication Log Record Table';

    public function handle()
    {
        foreach(AuthenticationLogRecord::all() as $log) {
            $this->info($log->recorded_at . ": " . $log->authenticatable->name . " logged in");
        }
    }
}