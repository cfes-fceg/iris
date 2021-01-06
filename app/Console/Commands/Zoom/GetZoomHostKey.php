<?php

namespace App\Console\Commands\Zoom\Zoom\Zoom;

use App\Support\Zoom;
use Illuminate\Console\Command;

class GetZoomHostKey extends Command
{
    protected $signature = 'zoom:host-key {email}';

    protected $description = 'Get zoom host key for user';

    public function handle()
    {
        $this->info("Host key for " . $this->argument('email') . " : " . Zoom::getUser($this->argument('email'))->host_key);
    }
}
