<?php namespace Domain\Shelf\Services;

use Domain\Shelf\DTOs\FillCategoryDTO;
use Domain\Shelf\Models\Category;
use Illuminate\Support\Facades\DB;
use Support\Exceptions\CrudException;
use Throwable;

class CategoryService
{
    public function create(FillCategoryDTO $data): Category
    {
        try {
            DB::beginTransaction();

            $category = Category::create([
                'name' => $data->name,
                'model' => $data->model,
                'slug' => $data->slug,
                'description' => $data->description
            ]);

            DB::commit();

            return $category;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }

    public function update(Category $category, FillCategoryDTO $data): Category
    {
        try {
            DB::beginTransaction();

            $category->fill(
                [
                    'name' => $data->name,
                    'model' => $data->model,
                    'slug' => $data->slug,
                    'description' => $data->description
                ]
            )->save();

            DB::commit();

            return $category;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }
}
