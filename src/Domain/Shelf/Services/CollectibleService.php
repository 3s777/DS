<?php

namespace Domain\Shelf\Services;

use Domain\Shelf\DTOs\FillCollectibleDTO;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Domain\Trade\DTOs\FillAuctionDTO;
use Domain\Trade\DTOs\FillSaleDTO;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
use Domain\Trade\Services\AuctionService;
use Domain\Trade\Services\SaleService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class CollectibleService
{
    private function preparedFields(FillCollectibleDTO $data) {
        return [
            'name' => $data->name,
            'ulid' => Str::ulid(),
            'shelf_id' => $data->shelf_id,
            'condition' => $data->condition,
            'kit_score' => $data->kit_score,
            'kit_conditions' => $data->kit_conditions,
            'article_number' => $data->article_number,
            'purchase_price' => $data->purchase_price,
            'purchased_at' => $data->purchased_at,
            'seller' => $data->seller,
            'additional_field' => $data->additional_field,
            'target' => $data->target,
            'description' => $data->description,
            'properties' => $data->properties
        ];
    }

    private function setSaleData(Collectible $collectible): void
    {
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

        $collectible->sale_data = $sale;

        $collectible->save();
    }

    private function setAuctionData(Collectible $collectible): void
    {

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

        $collectible->auction_data = $auction;

        $collectible->save();
    }

    private function createSaleDTO(int $collectible_id, FillCollectibleDTO $data): FillSaleDTO
    {
        return new FillSaleDTO(
            $collectible_id,
            $data->sale['price'],
            $data->sale['quantity'],
            $data->sale['bidding'] ?? false,
            $data->country_id,
            $data->shipping,
            $data->self_delivery ?? false,
            $data->sale['reservation'],
            $data->sale['price_old'],
            $data->shipping_countries
        );
    }

    private function createAuctionDTO(int $collectible_id, FillCollectibleDTO $data): FillAuctionDTO
    {
        return new FillAuctionDTO(
            $collectible_id,
            $data->auction['price'],
            $data->auction['step'],
            $data->auction['finished_at'],
            $data->country_id,
            $data->shipping,
            $data->self_delivery ?? false,
            $data->auction['blitz'],
            $data->auction['renewal'],
            $data->shipping_countries
        );
    }

    private function syncTradeWithTarget(string $target, Collectible $collectible): void
    {
        if($target == 'sale') {
            $collectible->auction()->delete();
            $collectible->auction_data = null;
        }

        if($target == 'auction') {
            $collectible->sale()->delete();
            $collectible->sale_data = null;
        }

        if($target != 'auction' && $target != 'sale') {
            $collectible->sale()->delete();
            $collectible->auction()->delete();
            $collectible->sale_data = null;
            $collectible->auction_data = null;
        }
    }

    public function create(FillCollectibleDTO $data)
    {
        return Transaction::run(
            function() use($data) {
                $collectible = Collectible::make($this->preparedFields($data));

                $shelf = Shelf::find($data->shelf_id);
                $collectible->collector_id = $shelf->collector_id;

                $collectible->collectable_id = $data->collectable;
                $collectible->collectable_type = $data->collectable_type;

                if(!$data->kit_score) {
                    $kit = array_filter($data->kit_conditions, function ($condition) {
                        return $condition;
                    });

                    if(!empty($kit)) {
                        $collectible->kit_score = round(array_sum($kit)/count($kit));
                    }
                }

                $collectible->save();

                if($data->target == 'sale') {
//                    $collectible->sale()->create([
//                        'price' =>  $data->sale['price'],
//                        'price_old' => $data->sale['price_old'],
//                        'quantity' => $data->sale['quantity'],
//                        'bidding' => $data->sale['bidding'] ?? false,
//                        'country_id' => $data->country_id,
//                        'shipping' => $data->shipping,
//                        'self_delivery' => $data->self_delivery ?? false,
//                        'reservation' => $data->sale['reservation'],
//                    ]);
//                    if(isset($data->shipping_countries)) {
//                        $collectible->sale->shippingCountries()->sync($data->shipping_countries);
//                    }

                    $saleService = new SaleService();
                    $saleService->create($this->createSaleDTO($collectible->id, $data));

//                    $this->setSaleData($collectible);
                }

                if($data->target == 'auction') {
//                    $collectible->auction()->create([
//                        'price' =>  $data->auction['price'],
//                        'step' => $data->auction['step'],
//                        'finished_at' => $data->auction['finished_at'],
//                        'blitz' => $data->auction['blitz'],
//                        'renewal' => $data->auction['renewal'],
//                        'country_id' => $data->country_id,
//                        'shipping' => $data->shipping ?? 'country',
//                        'self_delivery' => $data->self_delivery ?? false,
//                    ]);



                    $auctionService = new AuctionService();
                    $auctionService->create($this->createAuctionDTO($collectible->id, $data));



                    $this->setAuctionData($collectible);

//                    if(isset($data->shipping_countries)) {
//                        $collectible->auction->shippingCountries()->sync($data->shipping_countries);
//                    }
                }

                $kitItems = [];

                foreach($data->kit_conditions as $kitItem => $condition) {
                    if(KitItem::find($kitItem)->exists()) {
                        $kitItems[$kitItem] = ['condition' => $condition];
                    }
                }

                $collectible->kitItems()->sync($kitItems);


//            $kitItems = [];
//            foreach($data->kit_conditions as $key=>$value) {
//                $kitItems[$key] = ['condition' => $value];
//            }
//            $collectible->kitItems()->attach($kitItems);

                $collectible->addFeaturedImageWithThumbnail(
                    $data->featured_image,
                    ['small', 'medium']
                );

                if($data->images) {
                    foreach ($data->images as $key => $image) {
                        $collectible->addImagesWithThumbnail(
                            $image,
                            ['small', 'medium'],
                        );
                    }
                }

                return $collectible;
            },
            function(Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }

    public function update(Collectible $collectible, FillCollectibleDTO $data)
    {
        return Transaction::run(
            function() use($collectible, $data) {

                $collectible->updateFeaturedImage(
                    $data->featured_image,
                    $data->featured_image_uploaded,
                    ['small', 'medium']
                );

                $collectible->updateImages(
                    $data->images,
                    $data->images_delete,
                    ['small', 'medium']
                );

                $collectible->fill($this->preparedFields($data));
                $shelf = Shelf::find($data->shelf_id);
                $collectible->collector_id = $shelf->collector_id;

                if($data->target == 'sale') {
                    $saleService = new SaleService();
                    if($collectible->sale) {
                        $saleService->update($collectible->sale, $this->createSaleDTO($collectible->id, $data));
                    } else {
                        $saleService->create($this->createSaleDTO($collectible->id, $data));
                    }

//                    $this->setSaleData($collectible);
                }

                if($data->target == 'auction') {
                    $auctionService = new AuctionService();

                    if($collectible->auction) {
                        $auctionService->update($collectible->auction, $this->createAuctionDTO($collectible->id, $data));
                    } else {
                        $auctionService->create($this->createAuctionDTO($collectible->id, $data));
                    }

//                    dd($collectible, $collectible->auction);
//
//                    $this->setAuctionData($collectible);
                }

                $collectible->save();

                $kitItems = [];

                foreach($data->kit_conditions as $kitItem => $condition) {
                    if(KitItem::find($kitItem)->exists()) {
                        $kitItems[$kitItem] = ['condition' => $condition];
                    }
                }

                $collectible->kitItems()->sync($kitItems);

                return $collectible;
            },
            function(Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }
}
