<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ProductPaginationType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ProductPagination',
        'description' => 'A paginated list of products',
    ];

    public function fields(): array
    {
        return [
            'products' => [
                'type' => Type::listOf(GraphQL::type('Product')),
            ],
            'pageInfo' => [
                'type' => GraphQL::type('PageInfo'),
            ],
        ];
    }
}
