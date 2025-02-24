<?php

namespace Domain\Trade\Observers;

use Domain\Shelf\Models\Category;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
use Domain\Trade\Models\Auction;

class AuctionObserver
{
    private function auctionData(Auction $auction): array
    {
        $auction = [
            'price' => $auction->price->value(),
            'step' => $auction->step->value(),
            'finished_at' => $auction->finished_at,
            'blitz' => $auction->blitz->value(),
            'renewal' => $auction->renewal,
            'country_id' => $auction->country->id,
            'shipping' => ShippingEnum::tryFrom($auction->shipping)->value,
            'self_delivery' => $auction->self_delivery
        ];
        return $auction;
    }

    public function creating(Auction $auction):void
    {

    }

    public function created(Auction $auction): void
    {

    }

    public function saved(Auction $auction)
    {
        $auction->collectible->auction_data = $this->auctionData($auction);
        $auction->collectible->save();
    }

    /**
     * Handle the Auction "updated" event.
     */
    public function updated(Auction $auction): void
    {

    }

    public function deleting(Auction $auction)
    {
        dd($auction->collectible->auction_data);
    }

    /**
     * Handle the Auction "deleted" event.
     */
    public function deleted(Auction $auction): void
    {
        dd($auction->collectible->auction_data);
        $auction->collectible->auction_data = null;
        $auction->collectible->save();
    }

    /**
     * Handle the Auction "restored" event.
     */
    public function restored(Auction $auction): void
    {
        //
    }

    /**
     * Handle the Auction "force deleted" event.
     */
    public function forceDeleted(Auction $auction): void
    {
        //
    }
}
