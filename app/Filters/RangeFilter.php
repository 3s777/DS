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
    protected ?string $relation;

    public function __construct(
        string $title,
        string $key,
        string $table,
        ?string $field = null,
        array|string|null $placeholder = null,
        ?bool $isPrice = false,
        ?string $relation = null
    ) {
        parent::__construct($title, $key, $table, $field, $placeholder);

        $this->setIsPrice($isPrice);
        $this->setRelation($relation);
    }

    protected function setIsPrice(bool $isPrice): static
    {
        $this->isPrice = $isPrice;
        return $this;
    }

    protected function setRelation(?string $relation): static
    {
        $this->relation = $relation;
        return $this;
    }

    protected function rangeValues($from, $to): array
    {
        if($this->isPrice) {
            $from = PriceValueObject::make($from)->prepareValue();
            $to = PriceValueObject::make($to)->prepareValue();
        }

        return [
          'from' => $from,
          'to' => $to
        ];
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
            // extract $from and $to variables from rangeValues()
            extract(
                $this->rangeValues(
                    $this->requestValue('from', 0),
                    $this->requestValue('to', 10000000)
                )
            );

            if($this->relation) {
                $query->whereHas($this->relation, function (Builder $q) use($from, $to) {
                    $q->whereBetween($this->table.'.'.$this->field, [
                        $from,
                        $to
                    ]);
                });
            } else {
                $query->whereBetween($this->table.'.'.$this->field, [
                    $from,
                    $to
                ]);
            }
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
