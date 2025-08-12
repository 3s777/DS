<?php

namespace Domain\Auth\ViewModels\Public;

use Domain\Auth\FilterRegitrars\Public\CollectorFilterRegistrar;
use Domain\Auth\Models\Collector;
use Domain\Shelf\Enums\TargetEnum;
use Illuminate\Database\Eloquent\Builder;
use Spatie\ViewModels\ViewModel;

class CollectorsViewModel extends ViewModel
{
    public function collectors()
    {
        return Collector::query()->select(['id', 'slug', 'name', 'first_name'])
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
                }
            ])
            ->filtered(app(CollectorFilterRegistrar::class)->filtersList())
            ->paginate(4);
    }
}
