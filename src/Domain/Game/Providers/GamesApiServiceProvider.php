<?php

namespace Domain\Game\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Services\GamesDbApi\GamesApi;
use Services\GamesDbApi\GamesDbApiContract;

class GamesApiServiceProvider extends ServiceProvider
{
    public array $bindings = [
        GamesDbApiContract::class => GamesApi::class
    ];
}
