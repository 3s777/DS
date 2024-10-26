<?php namespace Domain\Shelf\Services;

use App\Exceptions\CrudException;
use Domain\Game\DTOs\FillGameDTO;
use Domain\Game\Models\Game;
use Domain\Shelf\DTOs\FillCollectibleDTO;
use Domain\Shelf\DTOs\FillShelfDTO;
use Domain\Shelf\Models\Shelf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class CollectibleService
{
    public function create(FillCollectibleDTO $data): Shelf
    {
        try {
            DB::beginTransaction();

            $shelf = Shelf::create([
                'name' => $data->name,
                'number' => $data->number,
                'ulid' => Str::ulid(),
                'user_id' => $data->user_id,
                'description' => $data->description,
            ]);

            $shelf->addImageWithThumbnail(
                $data->thumbnail,
                'thumbnail',
                ['small', 'medium']
            );

            DB::commit();

            return $shelf;

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
