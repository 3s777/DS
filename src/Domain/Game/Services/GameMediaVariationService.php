<?php

namespace Domain\Game\Services;

use Domain\Game\DTOs\FillGameMediaDTO;
use Domain\Game\DTOs\FillGameMediaVariationDTO;
use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GameMediaVariation;
use Illuminate\Support\Facades\DB;
use Support\Exceptions\CrudException;
use Throwable;

class GameMediaVariationService
{
    public function create(FillGameMediaVariationDTO $data): GameMediaVariation
    {
        try {
            DB::beginTransaction();

            $gameMedia = GameMediaVariation::create([
                'name' => $data->name,
                'slug' => $data->slug,
                'released_at' => $data->released_at,
                'user_id' => $data->user_id,
                'description' => $data->description,
                'alternative_names'  => explode('||', $data->alternative_names),
                'barcodes'  => explode('||', $data->barcodes),
                'article_number' => $data->article_number,
            ]);

            $gameMedia->addFeaturedImageWithThumbnail(
                $data->featured_image,
                ['small', 'medium']
            );

            if ($data->images) {
                foreach ($data->images as $key => $image) {
                    $gameMedia->addImagesWithThumbnail(
                        $image,
                        ['small', 'medium'],
                    );
                }
            }

            $gameMedia->games()->sync($data->games);
            $gameMedia->genres()->sync($data->genres);
            $gameMedia->platforms()->sync($data->platforms);
            $gameMedia->developers()->sync($data->developers);
            $gameMedia->publishers()->sync($data->publishers);
            $gameMedia->kitItems()->sync($data->kit_items);

            DB::commit();

            return $gameMedia;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }

    public function update(GameMediaVariation $gameMediaVariation, FillGameMediaVariationDTO $data): GameMediaVariation
    {
        try {
            DB::beginTransaction();

            $gameMediaVariation->updateFeaturedImage(
                $data->featured_image,
                $data->featured_image_uploaded,
                ['small', 'medium']
            );

            $gameMediaVariation->updateImages(
                $data->images,
                $data->images_delete,
                ['small', 'medium']
            );

            $gameMediaVariation->fill(
                [
                    'name' => $data->name,
                    'slug' => $data->slug,
                    'released_at' => $data->released_at,
                    'user_id' => $data->user_id ?? $gameMediaVariation->user_id,
                    'description' => $data->description,
                    'alternative_names'  => explode('||', $data->alternative_names),
                    'barcodes'  => explode('||', $data->barcodes),
                    'article_number' => $data->article_number,
                ]
            )->save();

//            $gameMedia->publishers()->sync($data->publishers);
            $gameMediaVariation->kitItems()->sync($data->kit_items);

            DB::commit();

            return $gameMediaVariation;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }
}
