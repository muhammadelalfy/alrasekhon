<?php

namespace App\Http\Controllers;

use App\Constants\OrderConstants;
use App\Events\GlobalNotificationEvent;
use App\Events\SegmentsUpdate;
use App\Models\Driver;
use App\Models\Notification;
use App\Notifications\FcmNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use JetBrains\PhpStorm\NoReturn;

class PlaygroundController extends Controller
{
    #[NoReturn] public function playground(Request $request)
    {
//        GlobalNotificationEvent::dispatch('test');
        SegmentsUpdate::dispatch();
//        dd(Cache::get(OrderConstants::SYNC_CACHE_KEY));
//        $driver = Driver::first();
//        $not = Notification::first();
//        $driver->notify(new FcmNotification($not));
//        dd(Carbon::parse('2022-11-01T12:46:22')->diffInMinutes(Carbon::parse('2022-12-20 10:52:09')));
    }
}
