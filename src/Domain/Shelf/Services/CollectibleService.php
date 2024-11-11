<?php

namespace Domain\Shelf\Services;

use App\Exceptions\CrudException;
use Domain\Shelf\DTOs\FillCollectibleDTO;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;
use Domain\Shelf\Enums\CollectibleTypeEnum;

class CollectibleService
{
    protected function preparedFields(FillCollectibleDTO $data) {
        return [
            'name' => $data->name,
            'ulid' => Str::ulid(),
            'shelf_id' => $data->shelf_id,
            'condition' => $data->condition,
            'kit_conditions' => $data->kit_conditions,
            'article_number' => $data->article_number,
            'purchase_price' => $data->purchase_price,
            'purchased_at' => $data->purchased_at,
            'seller' => $data->seller,
            'additional_field' => $data->additional_field,
            'properties' => $data->properties,
            'target' => $data->target,
            'description' => $data->description,
        ];
    }

    public function create(FillCollectibleDTO $data): Collectible
    {
        try {
            DB::beginTransaction();

            $collectible = Collectible::make($this->preparedFields($data));

            $shelf = Shelf::find($data->shelf_id);
            $collectible->user_id = $shelf->user_id;

            if($data->target == 'sale') {
                $sale = [
                    'price' => $data->sale['price'],
                    'price_old' => $data->sale['price_old'] ?? null
                ];
                $collectible->sale = $sale;
            }

            if($data->target == 'auction') {
                $auction = [
                    'price' => $data->auction['price'],
                    'to' => $data->auction['to'],
                    'step' => $data->auction['step']
                ];
                $collectible->auction = $auction;
            }

            $collectible->collectable_id = $data->media;
            $collectible->collectable_type = 'game_media';

            $collectible->save();

//            $kitItems = [];
//            foreach($data->kit_conditions as $key=>$value) {
//                $kitItems[$key] = ['condition' => $value];
//            }
//            $collectible->kitItems()->attach($kitItems);

            $collectible->addImageWithThumbnail(
                $data->thumbnail,
                'thumbnail',
                ['small', 'medium']
            );

            DB::commit();

            return $collectible;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }

    public function update(Collectible $collectible, FillCollectibleDTO $data): Collectible
    {
        try {
            DB::beginTransaction();

            $collectible->updateThumbnail(
                $data->thumbnail,
                $data->thumbnail_uploaded,
                ['small', 'medium']
            );

            $collectible->fill($this->preparedFields($data));

            $shelf = Shelf::find($data->shelf_id);
            $collectible->user_id = $shelf->user_id;

            if($data->target == 'sale') {
                $sale = [
                    'price' => $data->sale['price'],
                    'price_old' => $data->sale['price_old'] ?? null
                ];
                $collectible->sale = $sale;
            }

            if($data->target == 'auction') {
                $auction = [
                    'price' => $data->auction['price'],
                    'to' => $data->auction['to'],
                    'step' => $data->auction['step']
                ];
                $collectible->auction = $auction;
            }

            $collectible->save();

            DB::commit();

            return $collectible;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }
}
