<?php

namespace Domain\Auth\FilterRegitrars\Public;

use App\Contracts\FilterRegistrar;
use App\Filters\DatesFilter;
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
            )
        ];
    }
}
