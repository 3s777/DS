<?php

namespace App\Filters;

use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;

class SearchFilter extends AbstractFilter
{
    use Makeable;

    public function setField(string|null $field): static
    {
        $this->field = 'name';

        if($field) {
            $this->field = $field;
        }

        return $this;
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $query) {
            $query->where($this->table.'.'.$this->field, 'ILIKE', '%'.$this->requestValue().'%');
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
