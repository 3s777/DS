<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GameMediaVariation;
use Domain\Shelf\Models\Category;
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
//                'games:id,name',
//                'genres:id,name',
//                'platforms:id,name',
//                'developers:id,name',
//                'publishers:id,name',
//                'variations' => function($query) {
//                    $query->select(['id','slug','name','game_media_id','article_number','barcodes','is_main'])
//                        ->with(['media'])
//                        ->orderBy('is_main', 'DESC');
//                },

                'media'
            ])
            ->filtered()
            ->sorted()
            ->paginate(20)
            ->withQueryString();
    }
}
