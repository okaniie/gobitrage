<?php

namespace App\Providers;

use App\Handlers\PaymentHandler;
use App\Services\PaymentServices\CoinpaymentsService;
use App\Services\PaymentServices\Paykassa\PaykassaService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentHandler::class, function ($app) {
            $handler = new PaymentHandler();
            $handler->attach(new PaykassaService());
            // $handler->attach(new CoinpaymentsService());
            return $handler;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
