<?php

namespace Domain\Trade\Services;

use Domain\Trade\DTOs\FillAuctionDTO;
use Domain\Trade\Enums\ShippingEnum;
use Domain\Trade\Models\Auction;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class AuctionService
{
    public function create(FillAuctionDTO $data)
    {
        return Transaction::run(
            function() use($data) {

            $auction = Auction::create([
                'collectible_id' => $data->collectible_id,
                'price' => $data->price,
                'step' => $data->step,
                'finished_at' => $data->finished_at,
                'country_id' => $data->country_id,
                'shipping' => $data->shipping,
                'self_delivery' => $data->self_delivery,
                'blitz' => $data->blitz,
                'renewal' => $data->renewal,
            ]);

            if($data->shipping == ShippingEnum::Selected->value) {
                $auction->shippingCountries()->attach($data->shipping_countries);
            }

            return $auction;

            },
            function(Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }

    public function update(Auction $auction, FillAuctionDTO $data)
    {
        return Transaction::run(
            function() use($data, $auction) {

            $auction->fill(
                [
                    'price' => $data->price,
                    'step' => $data->step,
                    'finished_at' => $data->finished_at,
                    'country_id' => $data->country_id,
                    'shipping' => $data->shipping,
                    'self_delivery' => $data->self_delivery,
                    'blitz' => $data->blitz,
                    'renewal' => $data->renewal,
                ]
            )->save();

            if($data->shipping == ShippingEnum::Selected->value) {
                $auction->shippingCountries()->sync($data->shipping_countries);
            } else {
                $auction->shippingCountries()->detach();
            }

            return $auction;

            },
            function(Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }
}
