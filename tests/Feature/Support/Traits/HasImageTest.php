<?php

namespace Feature\Support\Traits;

use App\Contracts\ImagesManager;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use App\Models\Media;
use Carbon\Carbon;
use Database\Factories\Game\GameDeveloperFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Support\Images\MediaLibraryImageManager;
use Tests\TestCase;

class HasImageTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected GameDeveloper $gameDeveloper;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->storage = Storage::disk('images');
        $this->user = UserFactory::new()->create();

        $this->gameDeveloper = GameDeveloperFactory::new()->create();

        $this->app->bind(ImagesManager::class, MediaLibraryImageManager::class);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_add_original_image_with_thumbnail(): void
    {
        Queue::fake();

        $path = $this->gameDeveloper->addOriginalWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg'),
            'featured_image',
            ['small', 'medium']
        );

        Storage::disk('images')->assertExists($path);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);

        $this->gameDeveloper->forceDelete();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_generate_media_path(): void
    {
        $path = $this->gameDeveloper->generateMediaPath('test.jpg');

        $mediaCreatedDate = Carbon::make($this->gameDeveloper->created_at);

        $this->assertSame(
            $path,
            $this->gameDeveloper->imagesDir().'/'
            .$mediaCreatedDate->format('Y').'/'
            .$mediaCreatedDate->format('m').'/'
            .'test/'
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_success_generate_full_sizes(): void
    {
        Queue::fake();
        Storage::fake('images');

        $path = $this->gameDeveloper->generateMediaPath('test.jpg');

        $this->gameDeveloper->generateFullSizes($path);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_generate_thumbnails(): void
    {
        Queue::fake();
        Storage::fake('images');

        $path = $this->gameDeveloper->generateMediaPath('test.jpg');

        $this->gameDeveloper->generateThumbnails($path, ['small', 'medium']);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_image_manager(): void
    {
        $this->assertInstanceOf(ImagesManager::class, $this->gameDeveloper->imageManager());
    }
}
