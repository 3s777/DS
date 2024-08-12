<?php namespace Domain\Game\Services;

use App\Exceptions\CrudException;
use Domain\Game\DTOs\CreateGameDTO;
use Domain\Game\DTOs\CreateGameMediaDTO;
use Domain\Game\DTOs\UpdateGameDTO;
use Domain\Game\DTOs\UpdateGameMediaDTO;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameMedia;
use Illuminate\Support\Facades\DB;
use Throwable;

class GameMediaService
{
    public function create(CreateGameMediaDTO $data): GameMedia
    {
        try {
            DB::beginTransaction();

            $game = GameMedia::create([
                'name' => $data->name,
                'slug' => $data->slug,
                'released_at' => $data->released_at,
                'user_id' => $data->user_id,
                'description' => $data->description,
            ]);

            $game->addImageWithThumbnail(
                $data->thumbnail,
                'thumbnail',
                ['small', 'medium']
            );

            $game->genres()->sync($data->genres);
            $game->platforms()->sync($data->platforms);
            $game->developers()->sync($data->developers);
            $game->publishers()->sync($data->publishers);

            DB::commit();

            return $game;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }

    public function update(GameMedia $gameMedia, UpdateGameMediaDTO $data): GameMedia
    {
        try {
            DB::beginTransaction();

            $gameMedia->updateThumbnail(
                $data->thumbnail,
                $data->thumbnail_uploaded,
                ['small', 'medium']
            );

            $gameMedia->fill(
                [
                    'name' => $data->name,
                    'slug' => $data->slug,
                    'released_at' => $data->released_at,
                    'user_id' => $data->user_id ?? $gameMedia->user_id,
                    'description' => $data->description,
                ]
            )->save();

            $gameMedia->genres()->sync($data->genres);
            $gameMedia->platforms()->sync($data->platforms);
            $gameMedia->developers()->sync($data->developers);
            $gameMedia->publishers()->sync($data->publishers);

            DB::commit();

            return $gameMedia;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }
}
