<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPronounsAttributeToUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('pronouns')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pronouns');
        });
    }
}
