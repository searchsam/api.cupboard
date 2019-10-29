<?php

namespace App\GraphQL\Mutations;


use App\Order;
use App\Events\ShopOrder;
use App\Events\CreateNewOrder;

class OrderMutator
{
    /**
     * @param $root
     * @param array $args
     * @return mixed
     */
    public function create($root, array $args)
    {
        $deadline = $args['deadline'];
        $name = $args['name'];

        $order = auth()->user()->orders()->create([
            'name' => $name,
            'deadline' => $deadline
        ])->fresh();

        event(new CreateNewOrder($order));

        return $order;
    }

    /**
     * @param $root
     * @param array $args
     * @return mixed
     */
    public function update($root, array $args)
    {
        $orderId = $args['id'];
        $deadline = $args['deadline'];
        $name = $args['name'];

        return tap(Order::find($orderId))
            ->update([
                'deadline' => $deadline,
                'name' => $name
            ]);
    }

    /**
     * @param $root
     * @param array $args
     * @return mixed
     */
    public function shop($root, array $args)
    {
        $orderId = $args['id'];

        return tap(Order::find($orderId), function ($order) {
            $order->update(['status' => Order::COMPLETED]);
            event(new ShopOrder($order));
        });
    }
}
