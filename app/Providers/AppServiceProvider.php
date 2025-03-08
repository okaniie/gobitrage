<?php

namespace App\Providers;

use App\Console\Commands\ManualQueueCommand;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ManualQueueCommand::class, function ($app) {
            return new ManualQueueCommand($app['queue.worker'], $app['cache.store']);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
