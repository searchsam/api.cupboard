<?php

namespace App\GraphQL\Mutations;

use App\Request;
use Nuwave\Lighthouse\Execution\Utils\Subscription;

class RequestMutator
{

    /**
     * @param       $rootValue
     * @param array $args
     * @return mixed
     */
    public function create($rootValue, array $args)
    {
        $description = $args['description'];
        $orderId = $args['order_id'];
        $quantity = $args['quantity'];

        $request = auth()->user()->requests()->create([
            'description' => $description,
            'order_id'    => $orderId,
            'quantity'    => $quantity,
        ])->fresh();

        Subscription::broadcast('requestCreated', $request);

        return $request;
    }

    /**
     * @param       $rootValue
     * @param array $args
     * @return mixed
     */
    public function update($rootValue, array $args)
    {
        $requestId = $args['id'];
        $description = $args['description'];
        $quantity = $args['quantity'];

        return tap(Request::find($requestId))
            ->update([
                'description' => $description,
                'quantity'    => $quantity,
            ]);
    }

    /**
     * @param       $rootValue
     * @param array $args
     * @return mixed
     */
    public function deny($rootValue, array $args)
    {
        $requestId = $args['id'];

        return tap(Request::find($requestId))
            ->update(['status' => Request::REJECT]);
    }

    /**
     * @param       $rootValue
     * @param array $args
     * @return mixed
     */
    public function approve($rootValue, array $args)
    {
        $requestId = $args['id'];

        return tap(Request::find($requestId))
            ->update(['status' => Request::APPROVE]);
    }
}
