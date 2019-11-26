<?php

namespace App\GraphQL\Mutations;

use App\Exceptions\CustomException;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

use Nuwave\Lighthouse\Execution\Utils\Subscription;
use App\Request;

class RequestMutator
{
    /**
     * @param $rootValue
     * @param array $args
     * @return mixed
     */
    public function create($rootValue, array $args)
    {
        $description = $args['description'];
        $quantity = $args['quantity'];
        $orderId = $args['order_id'];

        $request = auth()->user()->requests()->create([
            'description' => $description,
            'quantity' => $quantity,
            'order_id' => $orderId
        ])->fresh();

        Subscription::broadcast('requestCreated', $request);

        return $request;
    }

    /**
     * @param $rootValue
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
                'quantity' => $quantity,
            ]);
    }

    /**
     * @param $rootValue
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
     * @param $rootValue
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
