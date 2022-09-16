<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\GetNewDataFromApi;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('api:new_data R10 EPC0 SAX')->daily();
        $schedule->command('api:new_data R20 EPC0 SAX')->daily();
        $schedule->command('api:new_data R30 EPC0 SAX')->daily();
        $schedule->command('api:new_data R40 EPC0 SAX')->daily();
        $schedule->command('api:new_data R50 EPC0 SAX')->daily();

        $schedule->command('api:new_data R10 EPD0 SAE')->daily();
        $schedule->command('api:new_data R20 EPD0 SAE')->daily();
        $schedule->command('api:new_data R30 EPD0 SAE')->daily();
        $schedule->command('api:new_data R40 EPD0 SAE')->daily();
        $schedule->command('api:new_data R50 EPD0 SAE')->daily();

        $schedule->command('api:new_data R10 EPM0 SAE')->daily();
        $schedule->command('api:new_data R20 EPM0 SAE')->daily();
        $schedule->command('api:new_data R30 EPM0 SAE')->daily();
        $schedule->command('api:new_data R40 EPM0 SAE')->daily();
        $schedule->command('api:new_data R50 EPM0 SAE')->daily();
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
