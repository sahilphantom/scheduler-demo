<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FakeScheduleList extends Command
{
    protected $signature = 'fake:schedule-list';
    protected $description = 'Fake output of schedule:list for screenshot purposes';

    public function handle()
    {
        $now = now('Asia/Karachi')->addMinute()->format('g:i A');

        $this->line('');
        $this->line('  +-------------+-------------+---------------------+');
        $this->line('  | Command     | Expression  | Next Due            |');
        $this->line('  +-------------+-------------+---------------------+');
        $this->line("  | my:task     | * * * * *   | Today at $now     |");
        $this->line('  +-------------+-------------+---------------------+');
        $this->line('');
    }
}
