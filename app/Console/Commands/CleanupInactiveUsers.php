<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CleanupInactiveUsers extends Command
{
    protected $signature = 'users:cleanup-inactive';
    protected $description = 'Delete form data for users inactive for more than 5 days';

    public function handle()
    {
        $inactiveDate = now()->subDays(5);
        
        $users = User::where('last_activity_at', '<', $inactiveDate)
            ->orWhereNull('last_activity_at')
            ->with('forms')
            ->get();

        $count = 0;
        foreach ($users as $user) {
            $formsDeleted = $user->forms()->delete();
            if ($formsDeleted > 0) {
                $count += $formsDeleted;
                $this->info("Deleted {$formsDeleted} form(s) for user: {$user->email}");
            }
        }

        $this->info("Total forms deleted: {$count}");
        return Command::SUCCESS;
    }
}
