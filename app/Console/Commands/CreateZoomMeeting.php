<?php

namespace App\Console\Commands;

use App\Support\Zoom;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Console\Command;

class CreateZoomMeeting extends Command
{
    protected $signature = 'zoom:create-meeting {email}';

    protected $description = 'Command description';

    public function handle()
    {
        $meeting = Zoom::createMeeting(
            "CELC - CCLI 2021 | " . "test",
            Carbon::now('America/Toronto'),
            Carbon::now('America/Toronto')->diff(Carbon::now()->add(CarbonInterval::hours(2))),
            $this->argument('email')
        );

        $this->info("Success!");
        $this->info("Meeting ID: " . $meeting->id);
    }
}
