<?php

namespace App\Shelf\Services;

use App\Http\Requests\Auth\User\CreateUserRequest;

use App\Http\Requests\Shelf\CreateCategoryRequest;
use Domain\Auth\Models\User;
use Domain\Shelf\DTOs\FillCategoryDTO;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Services\CategoryService;
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

    /**
     * @test
     * @return void
     */
    public function it_category_created_success(): void
    {
        $this->assertDatabaseMissing('categories', [
            'slug' => Str::slug($this->request['name'])
        ]);

        $request = new Request($this->request);

        $kitItemService = app(CategoryService::class);

        $kitItemService->create(FillCategoryDTO::fromRequest(
            $request
        ));

        $this->assertDatabaseHas('categories', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_category_updated_success(): void
    {

        $createRequest = new Request($this->request);

        $kitItemService = app(CategoryService::class);

        $kitItemService->create(FillCategoryDTO::fromRequest(
            $createRequest
        ));

        $category = Category::where('slug', Str::slug($this->request['name']))->first();

        $this->request['name'] = 'NewNameGame';
        $this->request['slug'] = 'newslug';

        $updateRequest = new Request($this->request);

        $kitItemService->update($category, FillCategoryDTO::fromRequest($updateRequest));

        $this->assertDatabaseHas('categories', [
            'slug' => 'newslug',
        ]);

        $updatedCategory = Category::where('slug', 'newslug')->first();

        $this->assertTrue($updatedCategory->slug == $this->request['slug']);
    }
}
