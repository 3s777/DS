<?php namespace Domain\Game\Services;

use App\Exceptions\CrudException;
use Domain\Game\DTOs\CreateGameDTO;
use Domain\Game\DTOs\UpdateGameDTO;
use Domain\Game\Models\Game;
use Illuminate\Support\Facades\DB;
use Throwable;

class GameService
{
    public function create(CreateGameDTO $data): Game
    {
        try {
            DB::beginTransaction();

            $game = Game::create([
                'name' => $data->name,
                'slug' => $data->slug,
                'released_at' => $data->released_at,
                'user_id' => $data->user_id,
                'description' => $data->description,
                'alternative_names' => explode('||', $data->alternative_names)
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

    public function update(Game $game, UpdateGameDTO $data)
    {
        try {
            DB::beginTransaction();

            $game->updateThumbnail(
                $data->thumbnail,
                $data->thumbnail_uploaded,
                ['small', 'medium']
            );

            $game->fill(
                [
                    'name' => $data->name,
                    'slug' => $data->slug,
                    'released_at' => $data->released_at,
                    'user_id' => $data->user_id ?? $game->user_id,
                    'description' => $data->description,
                    'alternative_names' => explode('||', $data->alternative_names)
                ]
            )->save();



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
}
