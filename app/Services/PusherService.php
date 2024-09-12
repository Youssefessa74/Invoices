<?php

namespace App\Services;

use App\Models\Pusher;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class PusherService {

    function getSetting(){
        return Cache::rememberForever('PusherSettings',function(){
            return Setting::pluck('value','key')->toArray();
        });

    }

    function setGlobalSettings(){
        $pusher = $this->getSetting();
        config()->set('PusherSettings',$pusher);
    }

    function clearCachedSettings(){
        Cache::forget('PusherSettings');
    }
}

