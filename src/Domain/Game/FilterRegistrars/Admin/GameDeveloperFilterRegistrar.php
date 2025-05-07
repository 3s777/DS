<?php

namespace Domain\Game\FilterRegistrars\Admin;

use App\Contracts\FilterRegistrar;
use App\Filters\DatesFilter;
use App\Filters\RelationFilter;
use App\Filters\SearchFilter;
use Domain\Auth\Models\User;

class GameDeveloperFilterRegistrar implements FilterRegistrar
{
    public function filtersList(): array
    {
        return [
            'dates' => DatesFilter::make(
                __('common.dates'),
                'dates',
                'game_developers',
                placeholder: [
                    'from' => __('filters.dates_from'),
                    'to' => __('filters.dates_to'),
                ],
            ),
            'search' => SearchFilter::make(
                __('common.search'),
                'search',
                'game_developers',
            ),
            'user' => RelationFilter::make(
                trans_choice('user.users', 1),
                'user',
                'game_developers',
                User::class,
                'user_id',
                __('users.choose')
            ),
        ];
    }
}
