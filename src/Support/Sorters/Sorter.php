<?php

declare(strict_types=1);

namespace Support\Sorters;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Stringable;

final class Sorter
{
    public const SORT_KEY = 'sort';

    public const SORT_ORDER = 'order';

    public function __construct(
        protected array $columns = []
    ) {}

    public function run(Builder $query): Builder
    {
        $sortData = $this->sortData();

        return $query->when($sortData['key']->contains($this->columns()), function (Builder $query) use ($sortData) {
            $query->orderBy(
                $sortData['key'], $sortData['order']
            );
        });
    }

    public function key(): string
    {
        return self::SORT_KEY;
    }

    public function order(): string
    {
        return self::SORT_ORDER;
    }

    public function columns(): array
    {
        return $this->columns;
    }

    public function sortData(): array
    {
        return [
            'key' =>  request()->str($this->key()),
            'order' => request($this->order()) ?? 'desc'
        ];
    }

//    public function isActive(string $column, string $direction = 'ASC'): bool
//    {
//        $column = trim($column, '-');
//
//        if(strtolower($direction) === 'DESC') {
//            $column = '-'.$column;
//        }
//
//        return request($this->key()) === $column;
//    }
}
