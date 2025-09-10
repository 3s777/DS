<?php

namespace Admin\Game\Services;

use Domain\Game\Models\Game;
use Admin\Game\DTOs\FillGameDTO;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class GameService
{
    public function create(FillGameDTO $data): Game
    {
        return Transaction::run(
            function () use ($data) {
                $game = Game::create([
                    'name' => $data->name,
                    'slug' => $data->slug,
                    'released_at' => $data->released_at,
                    'user_id' => $data->user_id,
                    'description' => $data->description,
                    'alternative_names' => explode('||', $data->alternative_names)
                ]);

                $game->addFeaturedImageWithThumbnail(
                    $data->featured_image,
                    ['small', 'medium']
                );

                if ($data->images) {
                    foreach ($data->images as $key => $image) {
                        $game->addImagesWithThumbnail(
                            $image,
                            ['small', 'medium'],
                        );
                    }
                }

                $game->genres()->sync($data->genres);
                $game->platforms()->sync($data->platforms);
                $game->developers()->sync($data->developers);
                $game->publishers()->sync($data->publishers);

                return $game;

            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }

    public function update(Game $game, FillGameDTO $data): Game
    {
        return Transaction::run(
            function () use ($game, $data) {
                $game->updateFeaturedImage(
                    $data->featured_image,
                    $data->featured_image_uploaded,
                    ['small', 'medium']
                );

                $game->updateImages(
                    $data->images,
                    $data->images_delete,
                    ['small', 'medium']
                );

                $game->fill(
                    [
                        'name' => $data->name,
                        'slug' => $data->slug,
                        'released_at' => $data->released_at,
                        'user_id' => $data->user_id ?? $game->user_id,
                        'description' => $data->description,
                        'alternative_names'  => explode('||', $data->alternative_names)
                    ]
                )->save();

                $game->genres()->sync($data->genres);
                $game->platforms()->sync($data->platforms);
                $game->developers()->sync($data->developers);
                $game->publishers()->sync($data->publishers);

                return $game;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }
}
