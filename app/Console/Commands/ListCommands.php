<?php

namespace App\Console\Commands;

use App\Support\Discord\Client;
use Illuminate\Console\Command;

class ListCommands extends Command
{
    protected $signature = 'discord:list-cmd';

    protected $description = 'Command description';

    public function handle()
    {
        $client = new Client();
        dump($client->listCommands());
    }
}
