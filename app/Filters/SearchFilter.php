<?php

namespace App\Filters;

use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;

class SearchFilter extends AbstractFilter
{
    use Makeable;

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $query) {
            $query->where($this->table.'.name','ILIKE',  '%'.$this->requestValue().'%');
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
