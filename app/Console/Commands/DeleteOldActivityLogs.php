<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:delete-old-activity-logs')]
#[Description('Delete activity logs older than 5 months')]
class DeleteOldActivityLogs extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deleted = ActivityLog::where(
            'created_at',
            '<',
            now()->subDays(1)
        )->delete();

        ActivityLog::create([
            'user_id' => null,
            'action' => 'Log Cleanup',
            'description' => "Automatically deleted {$deleted} activity log(s) older than 5 months.",
            'ip_address' => null,
            'user_agent' => null,
        ]);

        $this->info("Deleted {$deleted} old activity log(s).");

        return Command::SUCCESS;
    }
}