<?php

namespace App\Filters;

use Illuminate\Support\Carbon;
use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class DatesFilter extends AbstractFilter
{

    public function title(): string
    {
        return 'Начальная и конечная дата';
    }

    public function key(): string
    {
        return 'dates';
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $query) {

            if($this->requestValue('from')) {
                $fromDate = Carbon::createFromFormat('Y-m-d', $this->requestValue('from'));
            }

            if($this->requestValue('to')) {
                $toDate = Carbon::createFromFormat('Y-m-d', $this->requestValue('to'));
            }

            if(isset($fromDate)) {
                $query->whereDate('created_at','>=',  $fromDate);
            }

            if(isset($toDate)) {
                $query->whereDate('created_at','<=',  $toDate);
            }


//            if ($this->requestValue('from') && $this->requestValue('to')) {
//                $query->whereBetween('created_at',  [$this->requestValue('from'), $this->requestValue('to')]);
//            }
//
//            if($this->requestValue('from') && !$this->requestValue('to')) {
//                $query->whereDate('created_at',  $this->requestValue());
//            }
//
//            if(!$this->requestValue('from') && $this->requestValue('to')) {
//                $query->whereBetween('created_at',  ['2020-01-01', $this->requestValue('to')]);
//            }
        });
    }

    public function values(): array
    {
        return [];
    }

    public function view(): string
    {
        return 'components.common.filters.search';
    }
}
