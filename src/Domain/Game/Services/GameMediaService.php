<?php namespace Domain\Game\Services;

use Domain\Game\DTOs\FillGameMediaDTO;
use Domain\Game\Models\GameMedia;
use Illuminate\Support\Facades\DB;
use Support\Exceptions\CrudException;
use Throwable;

class GameMediaService
{
    public function create(FillGameMediaDTO $data): GameMedia
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
                $data->featured_image,
                'featured_image',
                ['small', 'medium']
            );

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

    public function update(GameMedia $gameMedia, FillGameMediaDTO $data): GameMedia
    {
        try {
            DB::beginTransaction();

            $gameMedia->updateFeaturedImage(
                $data->featured_image,
                $data->featured_image_uploaded,
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

            DB::commit();

            return $gameMedia;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }
}
