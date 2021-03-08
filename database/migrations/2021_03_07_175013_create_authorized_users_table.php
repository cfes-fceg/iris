<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorizedUsersTable extends Migration
{
    public function up()
    {
        Schema::create('authorized_users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('email')->unique();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('authorized_users');
    }
}
