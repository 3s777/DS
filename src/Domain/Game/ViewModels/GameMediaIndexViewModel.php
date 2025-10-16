<?php

namespace Domain\Game\ViewModels;

use Domain\Game\FilterRegistrars\GameMediaVariationFilterRegistrar;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
                'variations' => function (Builder $query) {
                    $query->select(['id','slug','name','game_media_id','article_number','barcodes','is_main'])
//                        ->with(['media' => function(MorphMany $query) {
//                            $query->select([
//                                    'media.id',
//                                    'media.model_type',
//                                    'media.model_id',
//                                    'media.collection_name',
//                                    'media.created_at',
//                                    'media.file_name',
//                                    'media.disk',
//                                    'media.generated_conversions'
//                                ]
//                            )
//                                ->where('collection_name', 'featured_image');
//                        }])
                        ->with([
                            'media' => function(Builder $query) {
                                $query->featured();
                            }
                        ])
                        ->orderBy('is_main', 'DESC');
                },
                'media' => function(Builder $query) {
                    $query->featured();
                }
//            'media'
            ])
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
