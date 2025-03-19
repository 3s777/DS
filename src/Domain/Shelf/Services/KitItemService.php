<?php

namespace Domain\Shelf\Services;

use Domain\Shelf\DTOs\FillKitItemDTO;
use Domain\Shelf\Models\KitItem;
use Illuminate\Support\Facades\DB;
use Support\Exceptions\CrudException;
use Throwable;

class KitItemService
{
    public function create(FillKitItemDTO $data): KitItem
    {
        try {
            DB::beginTransaction();

            $kitItem = KitItem::create([
                'name' => $data->name,
                'slug' => $data->slug,
                'user_id' => $data->user_id,
            ]);

            DB::commit();

            return $kitItem;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }

    public function update(KitItem $kitItem, FillKitItemDTO $data): KitItem
    {
        try {
            DB::beginTransaction();

            $kitItem->fill(
                [
                    'name' => $data->name,
                    'slug' => $data->slug,
                    'user_id' => $data->user_id,
                ]
            )->save();

            DB::commit();

            return $kitItem;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }
}
