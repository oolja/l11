<?php

declare(strict_types=1);

namespace App\Filters\V1;

use App\Filters\ApiFilter;

final class CategoryFilter extends ApiFilter
{
    protected array $filterable = [
        'restaurantId' => ['eq'],
        'name' => ['eq'],
    ];

    protected array $sortable = ['id', 'name'];

    protected array $columnMap = [
        'restaurantId' => 'restaurant_id',
    ];
}
