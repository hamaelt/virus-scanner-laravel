<?php

declare(strict_types=1);

namespace Hamaelt\VirusScanner\Providers;

use Hamaelt\VirusScanner\Icap\IcapClient;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../Config/virus-scanner.php'
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IcapClient::class, function ($app){
            return new IcapClient(
                config('virus-scanner.eset.host'),
                config('virus-scanner.eset.port'),
                config('virus-scanner.eset.service'),
            );
        });
    }
}