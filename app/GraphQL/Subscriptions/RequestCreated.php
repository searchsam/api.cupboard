<?php

namespace App\GraphQL\Subscriptions;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Http\Request;
use Nuwave\Lighthouse\Schema\Types\GraphQLSubscription;
use Nuwave\Lighthouse\Subscriptions\Subscriber;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

use App\Request as RequestModel;

class RequestCreated extends GraphQLSubscription
{

    /**
     * Check if subscriber is allowed to listen to the subscription.
     *
     * @param Subscriber $subscriber
     * @param Request    $request
     * @return bool
     */
    public function authorize(Subscriber $subscriber, Request $request): bool
    {
        return true;
    }

    /**
     * Filter which subscribers should receive the subscription.
     *
     * @param Subscriber $subscriber
     * @param mixed      $root
     * @return bool
     */
    public function filter(Subscriber $subscriber, $root): bool
    {
        return true;
    }

    /**
     * Resolve the subscription.
     *
     * @param \App\RequestModel $root
     * @param mixed[]           $args
     * @param GraphQLContext    $context
     * @param ResolveInfo       $resolveInfo
     * @return mixed
     */
    public function resolve($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): RequestModel
    {
        return $root;
    }
}
