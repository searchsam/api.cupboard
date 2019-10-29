<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

use App\Pantry;

class PantryMutator
{
    /**
     * @param $rootValue
     * @param array $args
     * @return mixed
     */
    public function decrease($rootValue, array $args)
    {
        $pantryId = $args['id'];

        return tap(Pantry::find($pantryId), function ($pantry) {
            $pantry->update(['existence' => $pantry->existence - Pantry::STOCK_UNIT]);
        });
    }
}
