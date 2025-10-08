<?php

namespace Domain\Game\ViewModels;

use Domain\Game\FilterRegistrars\GameMediaVariationFilterRegistrar;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\Category;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\ViewModels\ViewModel;

class GameMediaIndexViewModel extends ViewModel
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

    public function variationFilters(): array
    {
        return (new GameMediaVariationFilterRegistrar())->filtersList();
    }

    public function gameMedias()
    {
        return GameMedia::query()
            ->select(
                'game_medias.id',
                'game_medias.name',
                'game_medias.released_at',
                'game_medias.created_at',
                'game_medias.slug',
                'game_medias.description'
            )
            ->with([
                'games:id,name',
                'genres:id,name',
                'platforms:id,name',
                'developers:id,name',
                'publishers:id,name',
                'variations' => function ($query) {
                    $query->select(['id','slug','name','game_media_id','article_number','barcodes','is_main'])
                        ->with(['media' => function(MorphMany $query) {
                            $query->featured();
                        }])
                        ->orderBy('is_main', 'DESC');
                },
                'media' => function(MorphMany $query) {
                    $query->featured();
                }
            ])
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
