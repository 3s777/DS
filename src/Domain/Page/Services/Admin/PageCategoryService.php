<?php

namespace Domain\Page\Services\Admin;

use Domain\Page\DTOs\FillPageCategoryDTO;
use Illuminate\Support\HigherOrderTapProxy;
use Domain\Page\Models\PageCategory;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class PageCategoryService
{
    public function create(FillPageCategoryDTO $data): HigherOrderTapProxy|PageCategory
    {
        return Transaction::run(
            function () use ($data) {
                $pageCategory = PageCategory::create([
                    'name' => $data->name,
                    'slug' => $data->slug,
                    'description' => $data->description,
                    'user_id' => $data->user_id,
                    'parent_id' => $data->parent_id,
                ]);

                return $pageCategory;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }

    public function update(PageCategory $pageCategory, FillPageCategoryDTO $data): HigherOrderTapProxy|PageCategory
    {
        return Transaction::run(
            function () use ($data, $pageCategory) {

                $pageCategory->fill([
                    'name' => $data->name,
                    'slug' => $data->slug,
                    'description' => $data->description,
                    'user_id' => $data->user_id ?? $pageCategory->user_id,
                    'parent_id' => $data->parent_id ?? $pageCategory->parent_id,
                ])
                ->save();

                return $pageCategory;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }
}
