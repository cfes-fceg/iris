<?php

namespace App\Console\Commands\Discord;

use App\Support\Discord\Client;
use Illuminate\Console\Command;

class SyncCommand extends Command
{
    protected $signature = 'discord:sync-cmd {command_id?}';

    protected $description = 'Synchronize the discord command';

    public function handle()
    {
        $client = new Client();

        if ($this->hasArgument('command_id') && $this->argument('command_id') != null ) {
            $command_id = $this->argument('command_id');
            $response = $client->updateCelcCommand($command_id);
            $this->info(json_encode($response));
        } else {
            $response = $client->createCelcCommand();
            $this->info(json_encode($response));
        }
    }
}
