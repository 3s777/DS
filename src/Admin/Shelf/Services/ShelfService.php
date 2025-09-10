<?php

namespace Admin\Shelf\Services;

use Admin\Shelf\DTOs\FillShelfDTO;
use Domain\Shelf\Models\Shelf;
use Illuminate\Support\Str;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class ShelfService
{
    public function create(FillShelfDTO $data): Shelf
    {
        return Transaction::run(
            function () use ($data) {
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

                return $shelf;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }

    public function update(Shelf $shelf, FillShelfDTO $data): Shelf
    {
        return Transaction::run(
          function () use ($shelf, $data) {
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

              return $shelf;
            },
            function (Throwable $e) {
              throw new CrudException($e->getMessage());
            }
        );
    }
}
