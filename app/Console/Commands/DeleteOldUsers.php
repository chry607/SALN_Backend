<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteOldUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete users that were created more than 5 days ago';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $deletedCount = User::where('created_at', '<', now()->subDays(5))->delete();

        $this->info("Deleted {$deletedCount} users older than 5 days.");
    }
}
