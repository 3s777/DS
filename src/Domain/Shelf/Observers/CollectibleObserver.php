<?php

namespace Domain\Shelf\Observers;

use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;

class CollectibleObserver
{
    public function creating(Collectible $collectible):void
    {
        $collectible->category_id = Category::where('model', $collectible->collectable_type)->first()->id;
    }

    public function updated(Collectible $collectible): void
    {
        if($collectible->isDirty('target')) {
            if($collectible->target == 'sale' && $collectible->auction) {
                $collectible->auction->delete();
            }

            if($collectible->target == 'auction' && $collectible->sale) {
                $collectible->sale->delete();
            }

            if($collectible->target != 'auction' && $collectible->target != 'sale') {
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
