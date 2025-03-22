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

            $gameMediaVariation = GameMediaVariation::create([
                'name' => $data->name,
                'slug' => $data->slug,
                'game_media_id' => $data->game_media_id,
                'user_id' => $data->user_id,
                'description' => $data->description,
                'alternative_names'  => explode('||', $data->alternative_names),
                'barcodes'  => explode('||', $data->barcodes),
                'article_number' => $data->article_number,
                'is_main' => $data->is_main
            ]);

            $gameMediaVariation->addFeaturedImageWithThumbnail(
                $data->featured_image,
                ['small', 'medium']
            );


            if ($data->images) {
                foreach ($data->images as $key => $image) {
                    $gameMediaVariation->addImagesWithThumbnail(
                        $image,
                        ['small', 'medium'],
                    );
                }
            }

            $gameMediaVariation->kitItems()->sync($data->kit_items);

            DB::commit();

            return $gameMediaVariation;

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
                    'game_media_id' => $data->game_media_id,
                    'user_id' => $data->user_id ?? $gameMediaVariation->user_id,
                    'description' => $data->description,
                    'alternative_names'  => explode('||', $data->alternative_names),
                    'barcodes'  => explode('||', $data->barcodes),
                    'article_number' => $data->article_number,
                    'is_main' => $data->is_main
                ]
            )->save();

            $gameMediaVariation->kitItems()->sync($data->kit_items);


            DB::commit();

            return $gameMediaVariation;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }
}
