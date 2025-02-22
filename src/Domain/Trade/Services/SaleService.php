<?php namespace Domain\Trade\Services;

use Domain\Trade\DTOs\FillSaleDTO;
use Domain\Trade\Models\Sale;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class SaleService
{
    public function create(FillSaleDTO $data)
    {
        return Transaction::run(
            function() use($data) {

            $sale = Sale::create([
                'collectible_id' => $data->collectible_id,
                'price' => $data->price,
                'quantity' => $data->quantity,
                'bidding' => $data->bidding,
                'country_id' => $data->country_id,
                'shipping' => $data->shipping,
                'self_delivery' => $data->self_delivery,
                'reservation' => $data->reservation,
                'price_old' => $data->price_old,
            ]);

            if(isset($data->shipping_countries)) {
                $sale->shippingCountries()->sync($data->shipping_countries);
            }

            return $sale;

            },
            function(Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }

    public function update(Sale $sale, FillSaleDTO $data)
    {
        return Transaction::run(
            function() use($data, $sale) {

            $sale->fill(
                [
                    'price' => $data->price,
                    'quantity' => $data->quantity,
                    'bidding' => $data->bidding,
                    'country_id' => $data->country_id,
                    'shipping' => $data->shipping,
                    'self_delivery' => $data->self_delivery,
                    'reservation' => $data->reservation,
                    'price_old' => $data->price_old,
                ]
            )->save();

            if(isset($data->shipping_countries)) {
                $sale->shippingCountries()->sync($data->shipping_countries);
            }

            return $sale;

            },
            function(Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }
}
