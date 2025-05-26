<?php

declare(strict_types=1);

namespace App\Filters\V1;

use App\Filters\ApiFilter;

final class RestaurantsFilter extends ApiFilter
{
    protected array $filterable = [
        'name' => ['eq'],
    ];

    protected array $sortable = ['id'];
}
