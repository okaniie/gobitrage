<?php

namespace App\Console\Commands;

use App\Support\CalculateInterest as SupportCalculateInterest;
use Illuminate\Console\Command;

class CalculateInterest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:interest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate Investment Interests.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SupportCalculateInterest $calculateInterest)
    {
        return $calculateInterest->calculate();
    }
}
