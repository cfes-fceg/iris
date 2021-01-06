<?php

namespace App\Console\Commands;

use App\Imports\UsersImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportUsers extends Command
{
    protected $signature = 'users:import {file}';

    protected $description = 'Import CSV of users';

    public function handle()
    {
        Excel::import(new UsersImport, $this->argument('file'));
    }
}
