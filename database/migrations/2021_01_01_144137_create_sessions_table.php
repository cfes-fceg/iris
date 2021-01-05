<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('session_stream_id')->nullable(true);
            $table->string('title');
            $table->longText('description');
            $table->dateTimeTz('start');
            $table->dateTimeTz('end');
            $table->boolean('is_published');
            $table->bigInteger('zoom_meeting_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
