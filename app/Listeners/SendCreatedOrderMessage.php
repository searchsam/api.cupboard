<?php

namespace App\Listeners;

use App\Events\CreateNewOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Notifications\OrderCreated;
use Illuminate\Support\Facades\Notification;

class SendCreatedOrderMessage implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreateNewOrder  $event
     * @return void
     */
    public function handle(CreateNewOrder $event)
    {
        $users = User::all();

        Notification::send($users, new OrderCreated($event->order));
    }
}
