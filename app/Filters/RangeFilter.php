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
        return $query->when($this->requestValue('from') || $this->requestValue('to'), function (Builder $query) {
            $from = PriceValueObject::make($this->requestValue('from'))->prepareValue();
            $to = PriceValueObject::make($this->requestValue('to', 10000000))->prepareValue();

            $query->whereBetween($this->table.'.'.$this->field, [
                $from,
                $to
            ]);
        });
    }

    public function preparedValues(): ?string
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
