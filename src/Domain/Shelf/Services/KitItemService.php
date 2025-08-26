<?php

namespace Domain\Shelf\Services;

use Domain\Shelf\DTOs\FillKitItemDTO;
use Domain\Shelf\Models\KitItem;
use Illuminate\Support\Facades\DB;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class KitItemService
{
    public function create(FillKitItemDTO $data): KitItem
    {
        return Transaction::run(
            function () use ($data) {
                $kitItem = KitItem::create([
                    'name' => $data->name,
                    'slug' => $data->slug,
                    'user_id' => $data->user_id,
                ]);

                return $kitItem;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }

    public function update(KitItem $kitItem, FillKitItemDTO $data): KitItem
    {
        return Transaction::run(
            function () use ($kitItem, $data) {
                $kitItem->fill(
                    [
                        'name' => $data->name,
                        'slug' => $data->slug,
                        'user_id' => $data->user_id,
                    ]
                )->save();

                return $kitItem;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }
}
