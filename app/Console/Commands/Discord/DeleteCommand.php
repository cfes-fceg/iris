<?php

namespace App\Console\Commands\Zoom\Zoom\Zoom\Discord;

use App\Support\Discord\Client;
use Illuminate\Console\Command;

class DeleteCommand extends Command
{
    protected $signature = 'discord:delete-cmd {command_id?}';

    protected $description = 'Delete the discord command';

    public function handle()
    {
        $client = new Client();

        if (!$this->hasArgument('command_id') || $this->argument('command_id') == null) {
            $this->error("command_id is required");
        } else {
            $command_id = $this->argument('command_id');
            $client->deleteCelcCommand($command_id);
            $this->info("Deleted!");
        }
    }
}
