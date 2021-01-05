<?php

namespace App\Console\Commands;

use App\Support\Zoom;
use Illuminate\Console\Command;

class GetZoomMeeting extends Command
{
    protected $signature = 'zoom:get-meeting {id}';

    protected $description = 'Command description';

    public function handle()
    {
        $meeting = Zoom::getMeeting($this->argument('id'));
        dd($meeting);
    }
}
