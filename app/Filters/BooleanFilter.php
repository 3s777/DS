<?php

namespace App\Filters;

use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;

class BooleanFilter extends AbstractFilter
{
    use Makeable;

    public function placeholder(string $key = ''): string|array|null
    {
        if ($this->placeholder) {
            return $this->placeholder;
        }

        return __('common.yes');
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $query) {
            $query->where($this->table.'.'.$this->field, true);
        });
    }

    public function preparedValues(): string
    {
        return $this->placeholder();
    }

    public function view(): string
    {
        return '';
    }
}
