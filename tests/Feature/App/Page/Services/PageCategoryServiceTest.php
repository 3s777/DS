<?php

namespace App\Page\Services;

use App\Http\Requests\Auth\Admin\CreateAdminRequest;
use App\Http\Requests\Page\Admin\CreatePageCategoryRequest;
use Domain\Auth\Models\User;
use Domain\Page\DTOs\FillPageCategoryDTO;
use Domain\Page\Models\PageCategory;
use Domain\Page\Services\Admin\PageCategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Tests\TestCase;

class PageCategoryServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreatePageCategoryRequest::factory()->create();

        $this->user = User::factory()->create();
    }

    public function test_page_category_created_success(): void
    {
        $this->assertDatabaseMissing('page_categories', [
            'slug' => Str::slug($this->request['name'])
        ]);

        $this->request['user_id'] = $this->user->id;

        $request = new Request($this->request);

        $pageCategoryService = app(PageCategoryService::class);

        $pageCategoryService->create(FillPageCategoryDTO::fromRequest(
            $request
        ));

        $this->assertDatabaseHas('page_categories', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }


    public function test_page_category_updated_success(): void
    {
        $this->request['user_id'] = $this->user->id;

        $createRequest = new Request($this->request);

        $pageCategoryService = app(PageCategoryService::class);

        $pageCategoryService->create(FillPageCategoryDTO::fromRequest(
            $createRequest
        ));

        $pageCategory = PageCategory::where('slug', Str::slug($this->request['name']))->first();

        $this->request['name'] = 'NewNamePageCategory';
        $this->request['slug'] = 'new-slug';
        $this->request['description'] = 'NewDescription';

        $updateRequest = new CreateAdminRequest($this->request);

        $pageCategoryService->update($pageCategory, FillPageCategoryDTO::fromRequest($updateRequest));

        $this->assertDatabaseHas('page_categories', [
            'slug' => $this->request['slug']
        ]);

        $updatedPageCategory = PageCategory::where('slug', $this->request['slug'])->first();

        $this->assertSame($updatedPageCategory->slug, $this->request['slug']);
        $this->assertSame($updatedPageCategory->description, $this->request['description']);
    }
}
