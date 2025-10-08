<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GameMediaVariation;
use Domain\Shelf\Enums\TargetEnum;
use Spatie\ViewModels\ViewModel;
use Illuminate\Database\Eloquent\Builder;

class GameVariationShowViewModel extends ViewModel
{
    public ?GameMediaVariation $gameMediaVariation;

    public function __construct(GameMediaVariation $gameMediaVariation = null)
    {
        $this->gameMediaVariation = $gameMediaVariation;
    }

    public function gameMediaVariation(): ?GameMediaVariation
    {
        return $this->gameMediaVariation->loadCount([
            'collectibles as collection_count' => function(Builder $query) {
                $query->where('target', TargetEnum::Collection->value);
            },
            'collectibles as sale_count' => function(Builder $query) {
                $query->where('target', TargetEnum::Sale->value);
            },
            'collectibles as auction_count' => function(Builder $query) {
                $query->where('target', TargetEnum::Auction->value);
            },
            'collectibles as exchange_count' => function(Builder $query) {
                $query->where('target', TargetEnum::Exchange->value);
            },
        ])
            ?? null;
    }

    public function counter()
    {

    }
}
