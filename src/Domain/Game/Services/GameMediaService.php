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

            $gameMedia->addImageWithThumbnail(
                $data->thumbnail,
                'thumbnail',
                ['small', 'medium']
            );

            $gameMedia->games()->sync($data->games);
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

            DB::commit();

            return $gameMedia;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }
}
