<?php

namespace App\Filters;

use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;
use Support\ValueObjects\PriceValueObject;

class RangeFilter extends AbstractFilter
{
    use Makeable;

    public function placeholder(string $key = ''): string|array|null
    {
        if($this->placeholder) {
            return $this->placeholder;
        }

        return $this->title;
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue('from'), function (Builder $query) {

            if($this->requestValue('from')) {
                $from = PriceValueObject::make($this->requestValue('from'));
                $query->where($this->table.'.'.$this->field, '>=', $from->prepareValue());
            }

            if($this->requestValue('to')) {
                $to = PriceValueObject::make($this->requestValue('to'));
                $query->where($this->table.'.'.$this->field, '<=', $to->prepareValue());
            }

        });
    }

    public function preparedValues(): string
    {

        $this->requestValue('from') ? $values = $this->requestValue('from') : $values = $this->requestValue('to');

        if($this->requestValue('from') && $this->requestValue('to')) {
            $values = $this->requestValue('from').' - '.$this->requestValue('to');
        }

        return $values;
    }

    public function view(): string
    {
        return 'components.common.filters.search';
    }
}
