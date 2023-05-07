<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use LaravelFCM\Facades\Fcm as LaravelFcm;

class FCM extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LaravelFcm::class;
    }
}