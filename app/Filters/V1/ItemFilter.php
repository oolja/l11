<?php

declare(strict_types=1);

namespace App\Filters\V1;

use App\Filters\ApiFilter;

final class ItemFilter extends ApiFilter
{
    protected array $filterable = [
        'restaurantId' => ['eq'],
        'categoryId' => ['eq'],
        'name' => ['eq'],
        'price' => ['eq', 'lt', 'gt', 'lte', 'gte'],
    ];

    protected array $sortable = ['id', 'name', 'price'];

    protected array $columnMap = [
        'restaurantId' => 'restaurant_id',
        'categoryId' => 'category_id',
    ];
}
