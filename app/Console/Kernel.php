<?php

namespace App\Console;

use App\Console\Commands\FakeScheduleList;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\MyScheduledTask; // <-- Add this
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        MyScheduledTask::class,
        FakeScheduleList::class, 
    ];

    protected function schedule(Schedule $schedule)
{
    Log::info('📅 schedule() method was reached.');
    $schedule->command('my:task')->everyMinute();
}


    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
