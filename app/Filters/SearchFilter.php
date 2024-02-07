<?php

namespace App\Filters;

use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class SearchFilter extends AbstractFilter
{

    public function title(): string
    {
        return 'Поиск';
    }

    public function key(): string
    {
        return 'search';
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $query) {
            $query->where('name','like',  '%'.$this->requestValue().'%');
        });
    }

    public function values(): array
    {
        return [];
    }

    public function view(): string
    {
        return 'components.common.filters.search';
    }
}
