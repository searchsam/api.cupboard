<?php

namespace App\Listeners;

use App\Events\CreateNewOrder;
use App\Notifications\OrderCreated;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCreatedOrderMessage implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param CreateNewOrder $event
     * @return void
     */
    public function handle(CreateNewOrder $event)
    {
        $users = User::all();
        $users->notify(new OrderCreated($event->order));
    }
}
