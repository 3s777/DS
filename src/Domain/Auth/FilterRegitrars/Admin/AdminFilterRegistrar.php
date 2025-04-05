<?php

namespace Domain\Auth\FilterRegitrars\Admin;

use App\Contracts\FilterRegistrar;
use App\Filters\DatesFilter;
use App\Filters\SearchFilter;

class AdminFilterRegistrar implements FilterRegistrar
{
    public function filtersList(): array
    {
        return [
            'dates' => DatesFilter::make(
                __('common.dates'),
                'dates',
                'users',
                placeholder: [
                    'from' => __('filters.dates_from'),
                    'to' => __('filters.dates_to'),
                ],
            ),
            'search' => SearchFilter::make(
                __('common.search'),
                'search',
                'users',
            )
        ];
    }
}
