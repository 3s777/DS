<?php
namespace Domain\Page\Services\Admin;

use Domain\Page\DTOs\FillPageDTO;
use Domain\Page\Models\Page;
use Domain\Shelf\DTOs\FillCategoryDTO;
use Domain\Shelf\Models\Category;
use Illuminate\Support\HigherOrderTapProxy;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class PageService
{
    public function create(FillPageDTO $data): HigherOrderTapProxy|Page
    {
        return Transaction::run(
            function () use ($data) {

                $page = Page::create([
                    'name' => $data->name,
                    'slug' => $data->slug,
                    'description' => $data->description,
                    'user_id' => $data->user_id
                ]);

                $page->addFeaturedImageWithThumbnail(
                    $data->featured_image,
                    ['small', 'medium']
                );

                $page->categories()->sync($data->categories);

                return $page;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }

    public function update(Page $page, FillPageDTO $data)
    {
        return Transaction::run(
            function () use ($data, $page) {
                $page->updateFeaturedImage(
                    $data->featured_image,
                    $data->featured_image_uploaded,
                    ['small', 'medium']
                );

                $page->fill(
                    [
                        'name' => $data->name,
                        'slug' => $data->slug,
                        'description' => $data->description,
                        'user_id' => $data->user_id ?? $page->user_id,
                    ]
                )->save();

                $page->categories()->sync($data->categories);

                return $page;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }
}
