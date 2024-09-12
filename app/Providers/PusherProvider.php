<?php

namespace App\Providers;

use App\Services\PusherService;
use Illuminate\Support\ServiceProvider;

class PusherProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PusherService::class,function(){
            return new PusherService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $pusher =$this->app->make(PusherService::class);
        $pusher->setGlobalSettings();
    }
}
