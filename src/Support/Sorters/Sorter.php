<?php

namespace Support\Sorters;

use Illuminate\Contracts\Database\Eloquent\Builder;

class Sorter
{
    public const SORT_KEY = 'sort';

    public const SORT_ORDER = 'order';

    public function __construct(
        protected array $columns = [],
        protected string $defaultField = 'id',
        protected string $defaultOrder = 'desc'
    ) {}

    public function run(Builder $query): Builder
    {
        $sortData = $this->sortData();

        if(!request('sort')) {
            $query->orderBy(
                $this->defaultField, $this->defaultOrder
            );
        }

        $sortData['order'] = $sortData['order']->contains(['asc', 'desc']) ? $sortData['order'] : 'asc';

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
            'order' => request()->str($this->order()),
        ];
    }
}
