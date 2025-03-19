<?php

namespace Domain\Auth\FilterRegitrars;

use App\Contracts\FilterRegistrar;
use App\Filters\DatesFilter;
use App\Filters\SearchFilter;

class CollectorFilterRegistrar implements FilterRegistrar
{
    public function filtersList(): array
    {
        return [
            'dates' => DatesFilter::make(
                __('common.dates'),
                'dates',
                'collectors',
                placeholder: [
                    'from' => __('filters.dates_from'),
                    'to' => __('filters.dates_to'),
                ],
            ),
            'search' => SearchFilter::make(
                __('common.search'),
                'search',
                'collectors',
            )
        ];
    }
}
