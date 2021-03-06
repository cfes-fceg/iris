<?php

namespace App\Console;

use App\Console\Commands\CreateAccount;
use App\Console\Commands\ImportUsers;
use App\Console\Commands\ListCommands;
use App\Console\Commands\Zoom\CreateZoomMeeting;
use App\Console\Commands\Zoom\GetZoomHostKey;
use App\Console\Commands\Discord\DeleteCommand;
use App\Console\Commands\Discord\ListRoles;
use App\Console\Commands\Discord\SyncCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SyncCommand::class,
        DeleteCommand::class,
        ListRoles::class,
        CreateZoomMeeting::class,
        CreateAccount::class,
        GetZoomHostKey::class,
        ImportUsers::class,
        ListCommands::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
