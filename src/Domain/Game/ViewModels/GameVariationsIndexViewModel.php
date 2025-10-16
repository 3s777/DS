<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GameMediaVariation;
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Spatie\ViewModels\ViewModel;

class GameVariationsIndexViewModel extends ViewModel
{
    public Category $category;

    public function __construct(Category $category = null)
    {
        $this->category = $category;
    }

    public function category(): Category
    {
        return $this->category;
    }

    public function variations()
    {
        return GameMediaVariation::query()
            ->select(
                'game_media_variations.id',
                'game_media_variations.name',
                'game_media_variations.created_at',
                'game_media_variations.slug',
                'game_media_variations.article_number',
                'game_media_variations.barcodes'
            )
            ->with([
                'media' => function(Builder $query) {
                    $query->featured();
                }
            ])
            ->withCount([
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
            ->filtered()
            ->sorted()
            ->paginate(20)
            ->withQueryString();
    }
}
