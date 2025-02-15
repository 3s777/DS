<?php

namespace Domain\Shelf\Services;

use Domain\Shelf\DTOs\FillCollectibleDTO;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class CollectibleService
{
    protected function preparedFields(FillCollectibleDTO $data) {
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
            'description' => $data->description
        ];
    }

    protected function setSaleData(Collectible $collectible): void
    {
        $sale = [
            'price' => $collectible->sale->price->value(),
            'price_old' => $collectible->sale->price_old->value()
        ];
        $collectible->sale_data = $sale;

        $collectible->save();
    }

    protected function setAuctionData(Collectible $collectible): void
    {
        $auction = [
            'price' => $collectible->auction->price->value(),
            'step' => $collectible->auction->step->value(),
            'finished_at' => $collectible->auction->finished_at
        ];
        $collectible->auction_data = $auction;

        $collectible->save();
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
                $collectible->properties =  $data->properties;

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
                    $collectible->sale()->create([
                        'price' =>  $data->sale['price'],
                        'price_old' => $data->sale['price_old'] ?? null
                    ]);

                    $this->setSaleData($collectible);
                }

                if($data->target == 'auction') {
                    $collectible->auction()->create([
                        'price' =>  $data->auction['price'],
                        'step' => $data->auction['step'],
                        'finished_at' => $data->auction['finished_at']
                    ]);

                    $this->setAuctionData($collectible);
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
                    $collectible->auction()->delete();

                    $collectible->auction_data = null;

                    $collectible->sale()->updateOrCreate(
                        ['collectible_id' => $collectible->id],
                        ['price' =>  $data->sale['price'],
                        'price_old' => $data->sale['price_old']]
                    );

                    $this->setSaleData($collectible);
                }

                if($data->target == 'auction') {
                    $collectible->sale()->delete();
                    $collectible->sale_data = null;

                    $collectible->auction()->updateOrCreate(
                        ['collectible_id' => $collectible->id],
                        ['price' =>  $data->auction['price'],
                        'step' => $data->auction['step'],
                        'finished_at' => $data->auction['finished_at']]
                    );

                    $this->setAuctionData($collectible);
                }

                $collectible->properties =  $data->properties;

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
