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
        Session::factory()->count(3)->state([
            'session_stream_id' => null
        ])->create();

        foreach(SessionStream::factory()->count(3)->create()->all() as $stream) {
            Session::factory()->count(10)->state([
                'session_stream_id' => $stream->id
            ])->create();
        }
    }
}
