<?php

namespace Domain\Shelf\Observers;

use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;

class CollectibleObserver
{
    public function creating(Collectible $collectible):void
    {
        $collectible->category_id = Category::where('model', $collectible->collectable_type)->first()->id;
    }

    public function updated(Collectible $collectible): void
    {
        if($collectible->isDirty('target')) {
            if($collectible->target == TargetEnum::Sale->value && $collectible->auction) {
                $collectible->auction->delete();
            }

            if($collectible->target == TargetEnum::Auction->value && $collectible->sale) {
                $collectible->sale->delete();
            }

            if($collectible->target != TargetEnum::Auction->value && $collectible->target != TargetEnum::Sale->value) {
                if($collectible->sale) {
                    $collectible->sale->delete();
                }

                if($collectible->auction) {
                    $collectible->auction->delete();
                }
            }
        }
    }

    public function deleted(Collectible $collectible): void
    {
        if($collectible->sale) {
            $collectible->sale->delete();
        }

        if($collectible->auction) {
            $collectible->auction->delete();
        }
    }
}
