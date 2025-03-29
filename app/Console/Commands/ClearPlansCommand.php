<?php

namespace App\Console\Commands;

use App\Models\Plan;
use Illuminate\Console\Command;

class ClearPlansCommand extends Command
{
    protected $signature = 'plans:clear';
    protected $description = 'Remove all investment plans';

    public function handle()
    {
        if (!$this->confirm('Are you sure you want to remove all investment plans? This action cannot be undone.')) {
            $this->info('Operation cancelled.');
            return;
        }

        $count = Plan::count();
        
        try {
            Plan::truncate();
            $this->info("Successfully removed {$count} investment plans.");
        } catch (\Exception $e) {
            $this->error('Failed to remove plans: ' . $e->getMessage());
        }
    }
} 