<?php namespace Domain\Shelf\Services;

use Domain\Shelf\DTOs\FillCategoryDTO;
use Domain\Shelf\Models\Category;
use Illuminate\Support\Facades\DB;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class CategoryService
{
    public function create(FillCategoryDTO $data)
    {
        return Transaction::run(
            function() use($data) {

            $category = Category::create([
                'name' => $data->name,
                'model' => $data->model,
                'slug' => $data->slug,
                'description' => $data->description
            ]);

            return $category;

            },
            function(Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }

    public function update(Category $category, FillCategoryDTO $data)
    {
        return Transaction::run(
            function() use($data, $category) {

            $category->fill(
                [
                    'name' => $data->name,
                    'model' => $data->model,
                    'slug' => $data->slug,
                    'description' => $data->description
                ]
            )->save();


            return $category;

            },
            function(Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }

    public function setModelNullOnDelete(int|string|array $ids): void
    {
        if(!is_array($ids)) {
            $ids = explode(",", $ids);
        }

        foreach ($ids as $id) {
            $category = Category::find($id);
            $category->model = null;
            $category->save();
        }
    }
}
