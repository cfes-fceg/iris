<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddZoomHostFieldToSessionStreams extends Migration
{
    public function up()
    {
        Schema::table('session_streams', function (Blueprint $table) {
            $table->string('zoom_host', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::table('session_streams', function (Blueprint $table) {
            $table->dropColumn('zoom_host');
        });
    }
}
