<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('language', 10)->default('en');
            $table->string('school', 255)->nullable();
            $table->string('engsoc_pos', 255)->nullable();
            $table->string('program', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->boolean('is_active')->default(false);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('language');
            $table->dropColumn('school');
            $table->dropColumn('engsoc_pos');
            $table->dropColumn('program');
            $table->dropColumn('linkedin');
            $table->dropColumn('is_active');
        });
    }
}
