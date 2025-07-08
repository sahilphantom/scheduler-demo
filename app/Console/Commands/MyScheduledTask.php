<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MyScheduledTask extends Command
{
    protected $signature = 'my:task';
    protected $description = 'This task runs every minute for testing';

    public function handle()
    {
        Log::info('✅ MyScheduledTask ran at: ' . now());
        $this->info('Task executed at ' . now());
    }
}
