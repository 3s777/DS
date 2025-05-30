<?php

namespace App\Page\Services;

use App\Http\Requests\Page\Admin\CreatePageRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Domain\Auth\Models\User;
use Domain\Page\DTOs\FillPageDTO;
use Domain\Page\Models\Page;
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

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $request = new Request($this->request);

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

    /**
     * @test
     * @return void
     */
    public function it_category_updated_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $createRequest = new Request($this->request);

        $pageService = app(PageService::class);

        $pageService->create(FillPageDTO::fromRequest(
            $createRequest
        ));

        $page = Page::where('slug', Str::slug($this->request['name']))->first();

        $this->request['name'] = 'NewNamePage';
        $this->request['slug'] = 'newslug';
        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $updateRequest = new Request($this->request);

        $pageService->update($page, FillPageDTO::fromRequest($updateRequest));

        $this->assertDatabaseHas('pages', [
            'slug' => 'newslug',
        ]);

        $updatedPage = Page::where('slug', 'newslug')->first();

        $this->assertSame($updatedPage->slug, $this->request['slug']);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }
}
