<?php

namespace Domain\Trade\Observers;

use Domain\Trade\Models\Auction;

class AuctionObserver
{
    private function auctionData(Auction $auction): array
    {
        $auction = [
            'price' => $auction->price->value(),
            'step' => $auction->step->value(),
            'finished_at' => $auction->finished_at,
            'blitz' => $auction->blitz?->value(),
            'renewal' => $auction->renewal,
            'country_id' => $auction->country->id,
            'shipping' => $auction->shipping,
            'self_delivery' => $auction->self_delivery
        ];
        return $auction;
    }

    public function created(Auction $auction): void
    {
        $auction->collectible->auction_data = $this->auctionData($auction);
        $auction->collectible->save();
    }

    public function updated(Auction $auction): void
    {
        $auction->collectible->auction_data = $this->auctionData($auction);
        $auction->collectible->save();
    }

    public function deleted(Auction $auction): void
    {
        if ($auction->collectible) {
            $auction->collectible->auction_data = null;
            $auction->collectible->save();
        }
    }
}
