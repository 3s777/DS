<?php

namespace Domain\Shelf\FilterRegistrars;

use App\Contracts\FilterRegistrar;
use App\Filters\DatesFilter;
use App\Filters\RelationFilter;
use App\Filters\SearchFilter;
use Domain\Auth\Models\Collector;

class ShelfFilterRegistrar implements FilterRegistrar
{
    public function filtersList(): array
    {
        return [
            'dates' => DatesFilter::make(
                __('common.dates'),
                'dates',
                'shelves',
                placeholder: [
                    'from' => __('filters.dates_from'),
                    'to' => __('filters.dates_to'),
                ]
            ),
            'search' => SearchFilter::make(
                __('common.search'),
                'search',
                'shelves'
            ),
            'collector' => RelationFilter::make(
                trans_choice('user.collectors', 1),
                'collector',
                'shelves',
                Collector::class,
                'collector_id',
                trans_choice('user.collector.choose', 1),
            ),
        ];
    }
}
