<?php

namespace App\Console\Commands;

use App\Support\Zoom;
use Illuminate\Console\Command;

class CreateZoomMeeting extends Command
{
    protected $signature = 'zoom:create-meeting';

    protected $description = 'Command description';

    public function handle()
    {
        $meeting = Zoom::createMeeting("CELC - CCLI 2021 | "."test", "zoom.mars@cfes.ca");
        $this->info("Success!");
        $this->info("Meeting ID: ".$meeting->id);
    }
}
