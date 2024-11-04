<?php

namespace Domain\Shelf\Services;

use App\Exceptions\CrudException;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\DTOs\FillCollectibleDTO;
use Domain\Shelf\DTOs\FillShelfDTO;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class CollectibleService
{
    public function create(FillCollectibleDTO $data): Collectible
    {
        try {
            DB::beginTransaction();

            $collectible = Collectible::make([
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
                'sale' => $data->sale,
                'auction' => $data->auction,
                'user_id' => $data->user_id,
                'description' => $data->description,
            ]);

            $collectible->collectable_id = $data->media;
            $collectible->collectable_type = GameMedia::class;

            $kitItems = [];

            foreach($data->kit_conditions as $key=>$value) {
                $kitItems[$key] = ['condition' => $value];
            }

            $collectible->save();

            $collectible->kitItems()->attach($kitItems);

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

    public function update(Shelf $shelf, FillShelfDTO $data): Shelf
    {
        try {
            DB::beginTransaction();

            $shelf->updateThumbnail(
                $data->thumbnail,
                $data->thumbnail_uploaded,
                ['small', 'medium']
            );

            $shelf->fill(
                [
                    'name' => $data->name,
                    'number' => $data->number,
                    'user_id' => $data->user_id ?? $shelf->user_id,
                    'description' => $data->description,
                ]
            )->save();

            DB::commit();

            return $shelf;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }
}
