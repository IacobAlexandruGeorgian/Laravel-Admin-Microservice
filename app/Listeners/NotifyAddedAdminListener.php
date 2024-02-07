<?php

namespace App\Listeners;

use App\Events\AdminAddedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class NotifyAddedAdminListener
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
    public function handle(AdminAddedEvent $event): void
    {
        $user = $event->user;

        Mail::send('admin.adminAdded', [], function (Message $message) use ($user) {
            $message->to($user->email);
            $message->subject('You have been added to the Admin App!');
        });
    }
}
