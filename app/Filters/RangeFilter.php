<?php

namespace App\Filters;

use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;
use Support\ValueObjects\PriceValueObject;

class RangeFilter extends AbstractFilter
{
    use Makeable;

    protected ?bool $isPrice;

    public function __construct(
        string $title,
        string $key,
        string $table,
        ?string $field = null,
        array|string|null $placeholder = null,
        ?bool $isPrice = false
    ) {
        parent::__construct($title, $key, $table, $field, $placeholder);

        $this->setIsPrice($isPrice);
    }

    public function setIsPrice(bool $isPrice): static
    {
        $this->isPrice = $isPrice;
        return $this;
    }

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
            $from = $this->requestValue('from', 0);
            $to = $this->requestValue('to', 10000000);

            if($this->isPrice) {
                $from = PriceValueObject::make($this->requestValue('from'))->prepareValue();
                $to = PriceValueObject::make($this->requestValue('to', 10000000))->prepareValue();
            }

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
