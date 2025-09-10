<?php

namespace Domain\Auth\FilterRegitrars;

use App\Contracts\FilterRegistrar;
use App\Filters\SearchFilter;

class CollectorFilterRegistrar implements FilterRegistrar
{
    public function filtersList(): array
    {
        return [
            'search' => SearchFilter::make(
                __('common.search'),
                'search',
                'collectors',
                alternativeFields: ['first_name']
            )
        ];
    }
}
