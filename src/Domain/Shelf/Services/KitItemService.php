<?php namespace Domain\Shelf\Services;

use App\Exceptions\CrudException;
use Domain\Shelf\DTOs\FillKitItemDTO;
use Domain\Shelf\DTOs\FillShelfDTO;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class KitItemService
{
    public function create(FillKitItemDTO $data): KitItem
    {
        try {
            DB::beginTransaction();

            $kitItem = KitItem::create([
                'name' => $data->name,
                'slug' => $data->slug
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
                    'slug' => $data->slug
                ]
            )->save();

            DB::commit();

            return $kitItem;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }
}
