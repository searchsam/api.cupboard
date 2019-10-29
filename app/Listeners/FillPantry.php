<?php

namespace App\Listeners;

use App\Events\ShopOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Pantry;

class FillPantry
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
        $requests = $event->order->requests()->approved()->get();

        $requests->each(function ($request)
        {
            Pantry::create([
                'existence' => $request->quantity,
                'request_id' => $request->id
            ]);
        });
    }
}
