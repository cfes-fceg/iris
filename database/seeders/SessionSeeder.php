<?php

namespace Database\Seeders;

use App\Models\Session;
use App\Models\SessionStream;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SessionStream::factory()->count(3)->make()->each(function (SessionStream $stream) {
            Session::factory()->count(10)->make([
                'session_stream_id' => $stream->id
            ]);
        });
    }
}
