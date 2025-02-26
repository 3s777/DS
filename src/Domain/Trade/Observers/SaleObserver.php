<?php

namespace Domain\Trade\Observers;

use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
use Domain\Trade\Models\Sale;

class SaleObserver
{
    private function saleData(Sale $sale): array
    {
        $sale = [
            'price' => $sale->price->value(),
            'price_old' => $sale->price_old?->value(),
            'bidding' => $sale->bidding,
            'country_id' => $sale->country->id,
            'shipping' => $sale->shipping,
            'quantity' => $sale->quantity,
            'reservation' => $sale->reservation,
            'self_delivery' => $sale->self_delivery,
        ];

        return $sale;
    }

    public function created(Sale $sale): void
    {
        $sale->collectible->sale_data = $this->saleData($sale);
        $sale->collectible->save();
    }

    public function updated(Sale $sale): void
    {
        $sale->collectible->sale_data = $this->saleData($sale);
        $sale->collectible->save();
    }

    public function deleted(Sale $sale): void
    {
        if($sale->collectible) {
            $sale->collectible->sale_data = null;
            $sale->collectible->save();
        }
    }
}
