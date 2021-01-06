<?php

namespace App\Console\Commands\Discord;

use App\Support\Discord\Client;
use Illuminate\Console\Command;

class ListRoles extends Command
{
    protected $signature = 'discord:list-roles';

    protected $description = 'Command description';

    public function handle()
    {
        $client = new Client();

        $roles = $client->getGuildRoles();
        dump($roles);
    }
}
