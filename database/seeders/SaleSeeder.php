<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Enums\ShippingEnum;
use Domain\Trade\Models\Sale;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $collectibles = Collectible::where('target', 'sale')->get();

        if($collectibles) {
            foreach ($collectibles as $collectible) {
                $sale = Sale::factory()
                    ->for($collectible)
                    ->create();

                $collectible->sale_data = [
                    'price' => $sale->price->value(),
                    'country_id' => $sale->country->id,
                    'shipping' => ShippingEnum::tryFrom($sale->shipping)->value,
                    'price_old' => $sale->price_old->value()
                ];

                $collectible->save();
            }
        }
    }
}
