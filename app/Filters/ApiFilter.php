<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiFilter
{
    protected Builder $builder;

    protected array $filterable = [];

    protected array $sortable = [];

    protected array $columnMap = [];

    protected array $operatorMap = [
        'eq' => '=',
        'neq' => '<>',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

    public function __construct(
        public readonly Request $request,
    ) {}

    public function getBuilder(): Builder
    {
        return $this->builder;
    }

    public function setBuilder(Builder $builder): static
    {
        $this->builder = $builder;

        return $this;
    }

    public function filter(): static
    {
        $eloQuery = [];
        $filters = $this->request->only(array_keys($this->filterable));

        foreach ($filters as $param => $queries) {
            foreach ($queries as $operator => $value) {
                if (! isset($this->operatorMap[$operator]) ||
                    ! in_array($operator, $this->filterable[$param])
                ) {
                    continue;
                }

                $eloQuery[] = [$this->columnMap[$param] ?? $param, $this->operatorMap[$operator], $value];
            }
        }

        $this->builder->where($eloQuery);

        return $this;
    }

    public function include(): static
    {
        if (! $this->request->filled('include')) {
            return $this;
        }

        $include = strval($this->request->query('include'));

        $this->builder->with(explode(',', $include));

        return $this;
    }

    public function sort(): static
    {
        if (! $this->request->filled('sort')) {
            return $this;
        }

        $sort = strval($this->request->query('sort'));
        $fields = explode(',', $sort);

        foreach ($fields as $field) {
            $column = ltrim($field, '-');

            if (! in_array($column, $this->sortable)) {
                continue;
            }

            $direction = str_starts_with($field, '-') ? 'desc' : 'asc';

            $this->builder->orderBy($this->columnMap[$column] ?? $column, $direction);
        }

        return $this;
    }

    public function paginate(): LengthAwarePaginator
    {
        $perPage = $this->request->query('perPage');

        return $this->builder->paginate($perPage);
    }
}
