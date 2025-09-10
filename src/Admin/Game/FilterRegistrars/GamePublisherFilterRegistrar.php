<?php

namespace Admin\Game\FilterRegistrars;

use App\Contracts\FilterRegistrar;
use App\Filters\DatesFilter;
use App\Filters\RelationFilter;
use App\Filters\SearchFilter;
use Domain\Auth\Models\User;

class GamePublisherFilterRegistrar implements FilterRegistrar
{
    public function filtersList(): array
    {
        return [
            'dates' => DatesFilter::make(
                __('common.dates'),
                'dates',
                'game_publishers',
                placeholder: [
                    'from' => __('filters.dates_from'),
                    'to' => __('filters.dates_to'),
                ],
            ),
            'search' => SearchFilter::make(
                __('common.search'),
                'search',
                'game_publishers'
            ),
            'user' => RelationFilter::make(
                trans_choice('user.users', 1),
                'user',
                'game_publishers',
                User::class,
                'user_id',
                trans_choice('user.choose', 1)
            ),
        ];
    }
}
