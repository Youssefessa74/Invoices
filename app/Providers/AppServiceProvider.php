<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $keys = ['app_id','key','secret','cluster'];
        // $PusherCreds =Setting::whereIn('key',$keys)->pluck('value','key');
        // config(['broadcasting.connections.pusher.app_id'=> $PusherCreds['app_id']]);
        // config(['broadcasting.connections.pusher.key'=>$PusherCreds['key']]);
        // config(['broadcasting.connections.pusher.secret'=> $PusherCreds['secret']]);
        // config(['broadcasting.connections.pusher.options.cluster'=> $PusherCreds['cluster']]);
    }
}
