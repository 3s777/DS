<?php

namespace Domain\Game\Services;

use Domain\Game\DTOs\FillGameMediaDTO;
use Domain\Game\DTOs\FillGameMediaVariationDTO;
use Domain\Game\Models\GameMedia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HigherOrderTapProxy;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class GameMediaService
{
    private function createMainVariationDTO(GameMedia $gameMedia, FillGameMediaDTO $data): FillGameMediaVariationDTO
    {
        if ($gameMedia->getImages()) {
            $variationImages = array_map(function ($value) {
                return(Storage::disk('images')->path($value));
            }, $gameMedia->getImages());
        }

        return $variationDTO = FillGameMediaVariationDTO::make(
            name: $data->variation_name ?? $data->name,
            game_media_id: $gameMedia->id,
            article_number: $data->article_number,
            barcodes: $data->barcodes,
            alternative_names: $data->alternative_names,
            user_id: $data->user_id,
            kit_items: $data->kit_items,
            featured_image: $gameMedia->getFeaturedImagePath() ? Storage::disk('images')->path($gameMedia->getFeaturedImagePath()) : null,
            featured_image_uploaded: $data->featured_image_uploaded,
            images: $variationImages ?? null,
            images_delete: $data->images_delete,
            description: $data->description,
            is_main: true
        );
    }

    public function create(FillGameMediaDTO $data): HigherOrderTapProxy|GameMedia
    {
        return Transaction::run(
            function () use ($data) {

                $gameMedia = GameMedia::create([
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

                $variationService = new GameMediaVariationService();
                $variationService->create($this->createMainVariationDTO($gameMedia, $data));

                return $gameMedia;

            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }

    public function update(GameMedia $gameMedia, FillGameMediaDTO $data): HigherOrderTapProxy|GameMedia
    {
        return Transaction::run(
            function () use ($gameMedia, $data) {

                $gameMedia->updateFeaturedImage(
                    $data->featured_image,
                    $data->featured_image_uploaded,
                    ['small', 'medium']
                );

                $gameMedia->updateImages(
                    $data->images,
                    $data->images_delete,
                    ['small', 'medium']
                );

                $gameMedia->fill(
                    [
                        'name' => $data->name,
                        'slug' => $data->slug,
                        'released_at' => $data->released_at,
                        'user_id' => $data->user_id ?? $gameMedia->user_id,
                        'description' => $data->description,
                        'alternative_names'  => explode('||', $data->alternative_names),
                        'barcodes'  => explode('||', $data->barcodes),
                        'article_number' => $data->article_number,
                    ]
                )->save();

                $gameMedia->games()->sync($data->games);
                $gameMedia->genres()->sync($data->genres);
                $gameMedia->platforms()->sync($data->platforms);
                $gameMedia->developers()->sync($data->developers);
                $gameMedia->publishers()->sync($data->publishers);
                $gameMedia->kitItems()->sync($data->kit_items);

                return $gameMedia;

            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }
}
