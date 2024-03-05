<?php

namespace App\Filters;

use Illuminate\Support\Carbon;
use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;

class DatesFilter extends AbstractFilter
{
    use Makeable;

    protected function validateValue($dateName) {
        validator(request()->query(), [
            $dateName => 'date'
        ], [$dateName => __('validation.filter_date')])->validate();
    }

    public function uu($dateType) {
        if($this->requestValue($dateType)) {
            return Carbon::createFromFormat('Y-m-d', $this->requestValue($dateType));
        }

        return false;
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $query) {

//            if($this->requestValue('from')) {
//                $this->validateValue('filters.dates.from');
//                $fromDate = Carbon::createFromFormat('Y-m-d', $this->requestValue('from'));
//            }
//
//            if($this->requestValue('to')) {
//                $this->validateValue('filters.dates.to');
//                $toDate = Carbon::createFromFormat('Y-m-d', $this->requestValue('to'));
//            }

            $fromDate = $this->uu('from');

            $toDate = $this->uu('to');
            $this->validateValue('filters.dates.from');
            $this->validateValue('filters.dates.to');
            if($fromDate) {
                $query->whereDate('created_at','>=',  $fromDate);
            }

            if($toDate) {
                $query->whereDate('created_at','<=',  $toDate);
            }
        });
    }

    public function preparedValues(): mixed
    {
        $dates = $this->requestValue('from') ?? $this->requestValue('to');

        if($this->requestValue('from') && $this->requestValue('to')) {
            $dates = $this->requestValue('from').'-'.$this->requestValue('to');
        }

        return $dates;
    }

    public function view(): string
    {
        return 'components.common.filters.dates';
    }
}
