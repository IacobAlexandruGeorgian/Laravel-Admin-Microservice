<?php

namespace App\Listeners;

use App\Events\OrderCompletedEvent;
use App\Services\UserService;
use Illuminate\Support\Facades\Redis;

class UpdateRankingsListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCompletedEvent $event): void
    {
        $order = $event->order;

        $revenue = $order->influencer_total;

        $userService = new UserService();

        $user = $userService->get($order->user_id);
;
        Redis::zincrby('rankings', $revenue, $user->fullName());
    }
}
