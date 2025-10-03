<?php

namespace Domain\Auth\ViewModels;

use Domain\Auth\FilterRegistrars\CollectorFilterRegistrar;
use Domain\Auth\Models\Collector;
use Domain\Shelf\Enums\TargetEnum;
use Illuminate\Database\Eloquent\Builder;
use Spatie\ViewModels\ViewModel;

class CollectorsViewModel extends ViewModel
{
    public function collectors()
    {
        return Collector::query()->select([
            'id',
            'slug',
            'name',
            'first_name',
            'rating',
            ])
            ->with(['media'])
            ->withCount([
                'collectibles as collection' => function (Builder $query) {
                    $query->where('target', TargetEnum::Collection);
                },
                'collectibles as sale' => function (Builder $query) {
                    $query->where('target', TargetEnum::Sale);
                },
                'collectibles as auction' => function (Builder $query) {
                    $query->where('target', TargetEnum::Auction);
                },
                'collectibles as exchange' => function (Builder $query) {
                    $query->where('target', TargetEnum::Exchange);
                },
                'subscriptions as subscriptions_count',
                'subscribers as subscribers_count'
            ])
            ->filtered(app(CollectorFilterRegistrar::class)->filtersList())
            ->orderBy('id')
            ->paginate(12);

//        Если необходимо включить кэширование.
//        Дополнительно к этому необходимо создать механизм пересоздания кэша счетчиков при добавлении Collectible
//        $collectors = Collector::query()->select(['id', 'slug', 'name', 'first_name'])
//            ->with(['media'])
//            ->filtered(app(CollectorFilterRegistrar::class)->filtersList())
//            ->paginate(4);
//
//        $collectors->getCollection()->transform(
//            function ($collector) {
//                $collector->counts = Cache::rememberForever(
//                    "collector_counts:{$collector->id}",
//                    function () use ($collector)  {
//                        $collector->loadCount([
//                            'collectibles as collection' => function (Builder $query) {
//                                $query->where('target', TargetEnum::Collection);
//                            },
//                            'collectibles as sale' => function (Builder $query) {
//                                $query->where('target', TargetEnum::Sale);
//                            },
//                            'collectibles as auction' => function (Builder $query) {
//                                $query->where('target', TargetEnum::Auction);
//                            },
//                            'collectibles as exchange' => function (Builder $query) {
//                                $query->where('target', TargetEnum::Exchange);
//                            }
//                        ]);
//
//                        return [
//                            'collection' => $collector->collection,
//                            'sale' => $collector->sale,
//                            'auction' => $collector->auction,
//                            'exchange' => $collector->exchange,
//                        ];
//                });
//
//                return $collector;
//            }
//        );
//        return $collectors;
    }
}
