<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearOldLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clearold';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear logs that are older than 7 days.';

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
    public function handle()
    {
        $this->traverseAndDelete();
        return 0;
    }

    private function traverseAndDelete(string $path = '')
    {
        $path = empty($path) ? storage_path("logs") : $path;
        $files = scandir($path);
        foreach ($files as $file) {
            if (in_array($file, ['.', '..', '.gitignore'])) continue;
            if (is_dir("{$path}/{$file}")) $this->traverseAndDelete("{$path}/{$file}");
            else {
                if (filemtime("{$path}/{$file}") + 60 * 60 * 24 * 7 < time()) {
                    unlink("{$path}/{$file}");
                }
            }
        }
    }
}
