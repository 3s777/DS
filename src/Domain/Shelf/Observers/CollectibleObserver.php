<?php

namespace Domain\Shelf\Observers;

use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;

class CollectibleObserver
{
    private function saleData(Collectible $collectible): array
    {
        if($collectible->sale) {
            $sale = [
                'price' => $collectible->sale->price->value(),
                'price_old' => $collectible->sale->price_old->value(),
                'bidding' => $collectible->sale->bidding,
                'country_id' => $collectible->sale->country->id,
                'shipping' => ShippingEnum::tryFrom($collectible->sale->shipping)->value,
                'quantity' => $collectible->sale->quantity,
                'reservation' => ReservationEnum::tryFrom($collectible->sale->reservation)->value,
                'self_delivery' => $collectible->sale->self_delivery,
            ];
        }

        return $sale ?? [];
    }

    private function auctionData(Collectible $collectible): array
    {
        if($collectible->auction) {
            $auction = [
                'price' => $collectible->auction->price->value(),
                'step' => $collectible->auction->step->value(),
                'finished_at' => $collectible->auction->finished_at,
                'blitz' => $collectible->auction->blitz->value(),
                'renewal' => $collectible->auction->renewal,
                'country_id' => $collectible->auction->country->id,
                'shipping' => ShippingEnum::tryFrom($collectible->auction->shipping)->value,
                'self_delivery' => $collectible->auction->self_delivery
            ];
        }

        return $auction ?? [];
    }

    public function creating(Collectible $collectible):void
    {
        $collectible->category_id = Category::where('model', $collectible->collectable_type)->first()->id;
    }

    public function created(Collectible $collectible): void
    {

    }

    public function saved(Collectible $collectible)
    {
//
//        if($collectible->target == 'sale') {
//            $collectible->sale_data = $this->saleData($collectible);
//        }
//
//        if($collectible->target == 'auction') {
//            $collectible->auction_data = $this->auctionData($collectible);
//        }
//
//        $collectible->saveQuietly();
    }

    /**
     * Handle the Collectible "updated" event.
     */
    public function updated(Collectible $collectible): void
    {
        if($collectible->target == 'sale') {
            $collectible->auction()->delete();
//            $collectible->auction_data = null;
        }

        if($collectible->target == 'auction') {
            $collectible->sale()->delete();
//            $collectible->sale_data = null;
        }

        if($collectible->target != 'auction' && $collectible->target != 'sale') {
            $collectible->sale()->delete();
            $collectible->auction()->delete();
//            $collectible->sale_data = null;
//            $collectible->auction_data = null;
        }

        $collectible->saveQuietly();
    }

    /**
     * Handle the Collectible "deleted" event.
     */
    public function deleted(Collectible $collectible): void
    {
        $collectible->sale()->delete();
        $collectible->auction()->delete();
    }

    /**
     * Handle the Collectible "restored" event.
     */
    public function restored(Collectible $collectible): void
    {
        //
    }

    /**
     * Handle the Collectible "force deleted" event.
     */
    public function forceDeleted(Collectible $collectible): void
    {
        //
    }
}
