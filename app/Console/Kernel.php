<?php

namespace App\Console;

use App\Console\Commands\CalculateInterest;
use App\Console\Commands\ClearOldLogs;
use App\Console\Commands\ManualQueueCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    /**
     * Get the timezone that should be used by default for scheduled events.
     *
     * @return \DateTimeZone|string|null
     */
    protected function scheduleTimezone()
    {
        return env('APP_TIMEZONE', 'Europe/London');
    }


    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // calculate interests
        $schedule
            ->command(CalculateInterest::class)
            ->everyMinute()
            ->runInBackground();

        // clear logs older than 7 days
        $schedule->command(ClearOldLogs::class)
            ->daily()
            ->runInBackground();

        // process queue manually
        $schedule
            ->command(ManualQueueCommand::class)
            ->everyMinute()
            ->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    protected $commands = [
        Commands\ClearPlansCommand::class,
    ];
}
