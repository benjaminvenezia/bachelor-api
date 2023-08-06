<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     * Define the time after the token is deleted... (personal comment)
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            //In user table reset all points to 0 and increment the points_gage by the delta from user1 and user2.
            DB::table('users')->update([
                'points' => 0,
                // 'points_gage' => DB::raw('points_gage + (user1_points - user2_points)')
            ]);

            $response = Http::get('localhost:8000/api/user/distribute_gage_points/');
            info($response);
        })->everyMinute();
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
