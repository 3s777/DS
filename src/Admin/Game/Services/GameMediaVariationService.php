<?php

namespace Admin\Game\Services;

use Domain\Game\Models\GameMediaVariation;
use Admin\Game\DTOs\FillGameMediaVariationDTO;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class GameMediaVariationService
{
    public function create(FillGameMediaVariationDTO $data): GameMediaVariation
    {
        return Transaction::run(
            function () use ($data) {
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

                return $gameMediaVariation;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }

    public function update(GameMediaVariation $gameMediaVariation, FillGameMediaVariationDTO $data): GameMediaVariation
    {
        return Transaction::run(
            function () use ($gameMediaVariation, $data) {
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

                return $gameMediaVariation;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }
}
