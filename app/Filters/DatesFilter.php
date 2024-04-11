<?php

namespace App\Filters;

use Illuminate\Support\Carbon;
use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;

class DatesFilter extends AbstractFilter
{
    use Makeable;

    protected function fromDate(): bool|Carbon
    {
        if($this->requestValue('from')) {
            return Carbon::createFromFormat('Y-m-d', $this->requestValue('from'));
        }

        return false;
    }

    protected function toDate(): bool|Carbon
    {
        if($this->requestValue('to')) {
            return Carbon::createFromFormat('Y-m-d', $this->requestValue('to'));
        }

        return false;
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $query) {
            if($this->fromDate()) {
                $query->whereDate('created_at','>=',  $this->fromDate());
            }

            if($this->toDate()) {
                $query->whereDate('created_at','<=',  $this->toDate());
            }
        });
    }

    public function preparedValues(): ?string
    {
        $fromDate = '';
        $toDate = '';

        if($this->fromDate()) {
            $fromDate = $this->fromDate()->format('d.m.Y');
        }

        if($this->toDate()) {
            $toDate = $this->toDate()->format('d.m.Y');
        }

        $dates = $fromDate ?? $toDate;

        if($fromDate && $toDate) {
            $dates = $fromDate.' - '.$toDate;
        }

        return $dates;
    }

    public function view(): string
    {
        return 'components.common.filters.dates';
    }
}
