<?php

namespace App\Page\Services;

use App\Http\Requests\Page\Admin\CreatePageRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Domain\Auth\Models\User;
use Domain\Page\DTOs\FillPageDTO;
use Domain\Page\Services\Admin\PageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class PageServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreatePageRequest::factory()->create();

        $this->user = User::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_page_created_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->assertDatabaseMissing('pages', [
            'slug' => Str::slug($this->request['name'])
        ]);

        $request = new Request($this->request);

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $pageService = app(PageService::class);

        $pageService->create(FillPageDTO::fromRequest(
            $request
        ));

        $this->assertDatabaseHas('pages', [
            'slug' => Str::slug($this->request['name'])
        ]);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

//    /**
//     * @test
//     * @return void
//     */
//    public function it_category_updated_success(): void
//    {
//        $createRequest = new Request($this->request);
//
//        $categoryService = app(CategoryService::class);
//
//        $categoryService->create(FillCategoryDTO::fromRequest(
//            $createRequest
//        ));
//
//        $category = Category::where('slug', Str::slug($this->request['name']))->first();
//
//        $this->request['name'] = 'NewNameGame';
//        $this->request['slug'] = 'newslug';
//
//        $updateRequest = new Request($this->request);
//
//        $categoryService->update($category, FillCategoryDTO::fromRequest($updateRequest));
//
//        $this->assertDatabaseHas('categories', [
//            'slug' => 'newslug',
//        ]);
//
//        $updatedCategory = Category::where('slug', 'newslug')->first();
//
//        $this->assertSame($updatedCategory->slug, $this->request['slug']);
//    }
}
