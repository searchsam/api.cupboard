<?php

namespace App\Listeners;

use App\Events\ShopOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Pantry;

class FillPantry implements ShouldQueue
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
     * @param  ShopOrder  $event
     * @return void
     */
    public function handle(ShopOrder $event)
    {
        $requests = $event->order->requests()->approved()
            ->select('id as request_id', 'quantity as existence')
            ->get()
            ->toArray();

        $event->order->pantry()->createMany($requests);
    }
}
