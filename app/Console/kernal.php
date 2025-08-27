<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('email:daily-appointments')
            ->everyMinute()
            ->timezone('Asia/Kolkata')
            ->onSuccess(function () {
                Log::info('email:daily-appointments ran successfully at ' . now()->toDateTimeString());
            })
            ->onFailure(function () {
                Log::error('email:daily-appointments failed at ' . now()->toDateTimeString());
            });
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
