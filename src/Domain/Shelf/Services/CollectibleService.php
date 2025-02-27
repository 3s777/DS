<?php

namespace Domain\Shelf\Services;

use Domain\Shelf\DTOs\FillCollectibleDTO;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Domain\Trade\DTOs\FillAuctionDTO;
use Domain\Trade\DTOs\FillSaleDTO;
use Domain\Trade\Services\AuctionService;
use Domain\Trade\Services\SaleService;
use Illuminate\Support\HigherOrderTapProxy;
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
        ];
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
            $data->sale['price_old'] ?? null,
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
            $data->auction['blitz'] ?? null,
            $data->auction['renewal'] ?? null,
            $data->shipping_countries
        );
    }

    public function create(FillCollectibleDTO $data)
    {
        return Transaction::run(
            function() use($data) {

                // create Collectible, attach Collector, Collectable and Properties
                $collectible = Collectible::make($this->preparedFields($data));
                $shelf = Shelf::find($data->shelf_id);

                $collectible->collector_id = $shelf->collector_id;
                $collectible->collectable_id = $data->collectable;
                $collectible->collectable_type = $data->collectable_type;
                $collectible->properties = $data->properties;

                // calculate kit_score as avg kit items condition if kit_score is empty
                if(!$data->kit_score) {
                    $kit = array_filter($data->kit_conditions, function ($condition) {
                        return $condition;
                    });

                    if(!empty($kit)) {
                        $collectible->kit_score = round(array_sum($kit)/count($kit));
                    }
                }

                $collectible->save();

                // attach Sale or Auction
                if($data->target == 'sale') {
                    $saleService = new SaleService();
                    $saleService->create($this->createSaleDTO($collectible->id, $data));
                }

                if($data->target == 'auction') {
                    $auctionService = new AuctionService();
                    $auctionService->create($this->createAuctionDTO($collectible->id, $data));
                }

                // attach KitItems with pivot
                $kitItemsWithCondition = array_map(
                    function ($value) { return ['condition' => $value]; },
                    $data->kit_conditions ?? []
                );
                $collectible->kitItems()->attach($kitItemsWithCondition);

                // attach Images
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

                // update Images
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

                // update fields
                $collectible->fill($this->preparedFields($data));
                $shelf = Shelf::find($data->shelf_id);
                $collectible->collector_id = $shelf->collector_id;

                // update or create Sale or Auction
                if($data->target == 'sale') {
                    $saleService = new SaleService();

                    if($collectible->sale) {
                        $saleService->update($collectible->sale, $this->createSaleDTO($collectible->id, $data));
                    } else {
                        $saleService->create($this->createSaleDTO($collectible->id, $data));
                    }
                }

                if($data->target == 'auction') {
                    $auctionService = new AuctionService();

                    if($collectible->auction) {
                        $auctionService->update($collectible->auction, $this->createAuctionDTO($collectible->id, $data));
                    } else {
                        $auctionService->create($this->createAuctionDTO($collectible->id, $data));
                    }
                }

                $collectible->properties =  $data->properties;

                $collectible->save();

                // sync KitItems
                $kitItemsWithCondition = array_map(
                    function ($value) { return ['condition' => $value]; },
                    $data->kit_conditions ?? []
                );
                $collectible->kitItems()->sync($kitItemsWithCondition);

                return $collectible;
            },
            function(Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }
}
