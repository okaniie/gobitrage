<?php

namespace App\Console\Commands;

use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Worker;
use Illuminate\Queue\WorkerOptions;
use Illuminate\Support\Carbon;
use function Termwind\terminal;

class ManualQueueCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manualqueue:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually process queued jobs.';


    /**
     * The queue worker instance.
     *
     * @var \Illuminate\Queue\Worker
     */
    protected $worker;

    /**
     * The cache store implementation.
     *
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * Holds the start time of the last processed job, if any.
     *
     * @var float|null
     */
    protected $latestStartedAt;

    /**
     * Holds the status of the last processed job, if any.
     *
     * @var string|null
     */
    protected $latestStatus;


    /**
     * Create a new queue work command.
     *
     * @param  \Illuminate\Queue\Worker  $worker
     * @param  \Illuminate\Contracts\Cache\Repository  $cache
     * @return void
     */
    public function __construct(Worker $worker, Cache $cache)
    {
        parent::__construct();

        $this->cache = $cache;
        $this->worker = $worker;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->laravel->isDownForMaintenance()) return 0;

        $connection = $this->laravel['config']['queue.default'];

        $queue = $this->getQueue($connection);

        return $this->runWorker(
            $connection,
            $queue
        );
    }

    /**
     * Run the worker instance.
     *
     * @param  string  $connection
     * @param  string  $queue
     * @return int|null
     */
    protected function runWorker($connection, $queue)
    {
        $total = 10;
        $worker = $this->worker->setName('default')
            ->setCache($this->cache);

        while ($total--) {
            $worker->runNextJob(
                $connection,
                $queue,
                $this->gatherWorkerOptions()
            );
        }

        return;
    }


    /**
     * Store a failed job event.
     *
     * @param  \Illuminate\Queue\Events\JobFailed  $event
     * @return void
     */
    protected function logFailedJob(JobFailed $event)
    {
        $this->laravel['queue.failer']->log(
            $event->connectionName,
            $event->job->getQueue(),
            $event->job->getRawBody(),
            $event->exception
        );
    }

    /**
     * Get the queue name for the worker.
     *
     * @param  string  $connection
     * @return string
     */
    protected function getQueue($connection)
    {
        return $this->laravel['config']->get(
            "queue.connections.{$connection}.queue",
            'default'
        );
    }

    /**
     * Gather all of the queue worker options as a single object.
     *
     * @return \Illuminate\Queue\WorkerOptions
     */
    protected function gatherWorkerOptions()
    {
        return new WorkerOptions();
    }
}
