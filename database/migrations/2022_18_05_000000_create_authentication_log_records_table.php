<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthenticationLogRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('authenticationLogRecords', function(Blueprint $table) {
            $table->id();
            $table->foreignId('authenticatable_id');
            $table->string('authenticatable_type');
            $table->dateTime('recorded_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('authenticationLogRecords');
    }
}