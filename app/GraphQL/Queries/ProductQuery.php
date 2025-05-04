<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Http;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\Log; // <- add for logging/debugging

class ProductQuery extends Query
{
    protected $attributes = [
        'name' => 'productsWithPageInfo',
    ];

    public function type(): Type
    {
        return GraphQL::type('ProductPagination'); // we'll define this type
    }

    public function args(): array
    {
        return [
            'page' => [
                'type' => Type::int(),
                'description' => 'Page number',
            ],
            'limit' => [
                'type' => Type::int(),
                'description' => 'Number of products per page',
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        $startTime = microtime(true);
        $response = Http::get('https://fakestoreapi.com/products');

        // Log the response status and URL called
        Log::info('FakestoreAPI called', [
            'url' => $response->effectiveUri(),
            'status' => $response->status(),
        ]);

        $products = $response->json();

        Log::info('Number of products fetched', [
            'count' => count($products),
        ]);

        if ($response->failed()) {
            Log::error('FakestoreAPI request failed', [
                'url' => $response->effectiveUri(),
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        
            throw new \Exception('Failed to fetch products');
        }

        $duration = microtime(true) - $startTime;

        Log::info('FakestoreAPI response time', [
            'duration_in_seconds' => $duration
        ]);

        $page = $args['page'] ?? 1;
        $limit = $args['limit'] ?? 10;
        $offset = ($page - 1) * $limit;

        $paginatedProducts = array_slice($products, $offset, $limit);

        return [
            'products' => $paginatedProducts,
            'pageInfo' => [
                'totalProducts' => count($products),
                'totalPages' => ceil(count($products) / $limit),
                'currentPage' => $page,
                'perPage' => $limit,
            ],
        ];
    }
}
