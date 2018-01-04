<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;
use Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $url = env('APP_DEVELOPMENT_URL');

        if (!str_contains($url, 'local') || !str_contains($url, '127')) {
            $url = env('APP_PRODUCTION_URL');
        }

        // adds new records every hour.
        $today = Carbon::now('America/New_York')->format('Y-m-d');
        $hour = Carbon::now('America/New_York')->hour;
        $minute = Carbon::now('America/New_York')->minute;
        $records = rand(2, 3);
        $command = "curl -X GET '" . $url . "curl/createrecords?url=http://google.com&dt_start=$today&dt_end=$today&records=$records&zero_sales_only=0'";
        log::info('Command: ' . $command);
        log::info('Records: ' . $records);
        $schedule->exec($command)->hourly();
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
}
