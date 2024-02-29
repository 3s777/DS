<?php

namespace App\Filters;

use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;

class SearchFilter extends AbstractFilter
{
    use Makeable;

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

    public function preparedValues(): string
    {
        return str($this->requestValue())->value();
    }

    public function view(): string
    {
        return 'components.common.filters.search';
    }
}
