<?php

namespace App\Filters;

use Illuminate\Support\Carbon;
use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;

class DatesFilter extends AbstractFilter
{
    use Makeable;

    protected ?string $relation;

    public function __construct(
        string $title,
        string $key,
        string $table,
        ?string $field = null,
        array|string|null $placeholder = null,
        ?string $relation = null
    ) {
        parent::__construct($title, $key, $table, $field, $placeholder);

        $this->setRelation($relation);
    }

    protected function setField(string|null $field): static
    {
        $this->field = 'created_at';

        if ($field) {
            $this->field = $field;
        }

        return $this;
    }

    protected function setRelation(?string $relation): static
    {
        $this->relation = $relation;
        return $this;
    }

    protected function fromDate(): bool|Carbon
    {
        return Carbon::createFromFormat('Y-m-d', $this->requestValue('from', '0001-01-01'))
            ->startOfDay();
    }

    protected function toDate(): bool|Carbon
    {
        return Carbon::createFromFormat('Y-m-d', $this->requestValue('to', '3000-01-01'))
            ->endOfDay();
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue('from') || $this->requestValue('to'), function (Builder $query) {
            //            if($this->fromDate()) {
            //                $query->whereDate($this->table.'.'.$this->field, '>=', $this->fromDate());
            //            }
            //
            //            if($this->toDate()) {
            //                $query->whereDate($this->table.'.'.$this->field, '<=', $this->toDate());
            //            }

            if ($this->relation) {
                $query->whereHas($this->relation, function (Builder $q) {
                    $q->whereBetween($this->table.'.'.$this->field, [$this->fromDate(), $this->toDate()]);
                });
            } else {
                $query->whereBetween($this->table.'.'.$this->field, [$this->fromDate(), $this->toDate()]);
            }
        });
    }

    public function preparedValues(): ?string
    {
        $fromDate = '';
        $toDate = '';

        if ($this->requestValue('from')) {
            $fromDate = $this->fromDate()->format('d.m.Y');
        }

        if ($this->requestValue('to')) {
            $toDate = $this->toDate()->format('d.m.Y');
        }

        $fromDate ? $dates = $fromDate : $dates = $toDate;

        if ($fromDate && $toDate) {
            $dates = $fromDate.' - '.$toDate;
        }

        return $dates;
    }

    public function view(): string
    {
        return 'components.common.filters.dates';
    }
}
