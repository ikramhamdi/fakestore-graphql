<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class PageInfoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'PageInfo',
        'description' => 'Pagination metadata',
    ];

    public function fields(): array
    {
        return [
            'total' => [
                'type' => Type::int(),
                'description' => 'Total number of products',
            ],
            'currentPage' => [
                'type' => Type::int(),
                'description' => 'Current page number',
            ],
            'totalPages' => [
                'type' => Type::int(),
                'description' => 'Total number of pages',
            ],
        ];
    }
}
