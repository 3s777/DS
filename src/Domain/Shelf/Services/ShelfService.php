<?php

namespace Domain\Shelf\Services;

use Domain\Shelf\DTOs\FillShelfDTO;
use Domain\Shelf\Models\Shelf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Support\Exceptions\CrudException;
use Throwable;

class ShelfService
{
    public function create(FillShelfDTO $data): Shelf
    {
        try {
            DB::beginTransaction();

            $shelf = Shelf::create([
                'name' => $data->name,
                'number' => $data->number,
                'ulid' => Str::ulid(),
                'collector_id' => $data->collector_id,
                'description' => $data->description,
            ]);

            $shelf->addFeaturedImageWithThumbnail(
                $data->featured_image,
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

            $shelf->updateFeaturedImage(
                $data->featured_image,
                $data->featured_image_uploaded,
                ['small', 'medium']
            );

            $shelf->fill(
                [
                    'name' => $data->name,
                    'number' => $data->number,
                    'collector_id' => $data->collector_id ?? $shelf->collector_id,
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
