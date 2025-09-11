<?php

namespace Admin\Shelf\Services;

use Admin\Shelf\DTOs\FillCategoryDTO;
use App\Admin\Http\Requests\Shelf\CreateCategoryRequest;
use Domain\Auth\Models\User;
use Domain\Shelf\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Tests\TestCase;

class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateCategoryRequest::factory()->create();

        $this->user = User::factory()->create();
    }

    public function test_category_created_success(): void
    {
        $this->assertDatabaseMissing('categories', [
            'slug' => Str::slug($this->request['name'])
        ]);

        $request = new Request($this->request);

        $categoryService = app(CategoryService::class);

        $categoryService->create(FillCategoryDTO::fromRequest(
            $request
        ));

        $this->assertDatabaseHas('categories', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    public function test_category_updated_success(): void
    {
        $createRequest = new Request($this->request);

        $categoryService = app(CategoryService::class);

        $categoryService->create(FillCategoryDTO::fromRequest(
            $createRequest
        ));

        $category = Category::where('slug', Str::slug($this->request['name']))->first();

        $this->request['name'] = 'NewNameGame';
        $this->request['slug'] = 'newslug';

        $updateRequest = new Request($this->request);

        $categoryService->update($category, FillCategoryDTO::fromRequest($updateRequest));

        $this->assertDatabaseHas('categories', [
            'slug' => 'newslug',
        ]);

        $updatedCategory = Category::where('slug', 'newslug')->first();

        $this->assertSame($updatedCategory->slug, $this->request['slug']);
    }

    public function test_category_model_null_after_deleting_success(): void
    {
        $categoryService = app(CategoryService::class);

        // test null model with array
        $categories = Category::factory(5)->create();
        foreach ($categories as $category) {
            $this->assertNotNull($category->model);
        }
        $ids = $categories->pluck('id')->toArray();
        $categoryService->setModelNullOnDelete($ids);
        $categories = Category::all();
        foreach ($categories as $category) {
            $this->assertNull($category->model);
        }

        // test null model with string
        $newCategories = Category::factory(5)->create();
        foreach ($newCategories as $category) {
            $this->assertNotNull($category->model);
        }
        $newIds = $newCategories->pluck('id')->toArray();
        $newIds = implode(',', $newIds);
        $categoryService->setModelNullOnDelete($newIds);
        $categories = Category::all();
        foreach ($categories as $category) {
            $this->assertNull($category->model);
        }

        // test null model with id
        $category = Category::factory()->create();
        $categoryService->setModelNullOnDelete($category->id);
        $category->refresh();
        $this->assertNull($category->model);
    }
}
