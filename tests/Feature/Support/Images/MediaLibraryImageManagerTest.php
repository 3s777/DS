<?php

namespace Feature\Support\Images;

use App\Contracts\ImagesManager;
use App\Models\Media;
use Database\Factories\Game\GameDeveloperFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameMedia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Support\Images\MediaLibraryImageManager;
use Tests\TestCase;

class MediaLibraryImageManagerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected GameDeveloper $gameDeveloper;
    protected ImagesManager $imagesManager;


    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();

        $this->app->bind(ImagesManager::class, MediaLibraryImageManager::class);

        $this->gameDeveloper = GameDeveloperFactory::new()->create();
        $this->imagesManager = app(ImagesManager::class, ['model' => $this->gameDeveloper]);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_instance(): void
    {
        $this->assertInstanceOf(MediaLibraryImageManager::class, $this->imagesManager);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_add(): void
    {
        $path = $this->imagesManager->add(UploadedFile::fake()->image('photo1.jpg'), 'featured_image');
        Storage::disk('images')->assertExists($path);

        $this->assertSame(
            Storage::disk('images')->url($path),
            $this->gameDeveloper->getFirstMediaUrl('featured_image')
        );
        $this->gameDeveloper->forceDelete();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_delete(): void
    {
        $path = $this->imagesManager->add(UploadedFile::fake()->image('photo1.jpg'), 'featured_image');

        $this->imagesManager->deleteByPath($path);

        Storage::disk('images')->assertMissing($path);

        $this->assertEmpty(Media::all());

        $this->gameDeveloper->forceDelete();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_delete_featured_image(): void
    {
        $path = $this->imagesManager->add(UploadedFile::fake()->image('photo1.jpg'), 'featured_image');

        $this->imagesManager->deleteFeaturedImage();

        Storage::disk('images')->assertMissing($path);

        $this->assertEmpty(Media::all());

        $this->gameDeveloper->forceDelete();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_get_featured_image_path(): void
    {
        $path = $this->imagesManager->add(UploadedFile::fake()->image('photo1.jpg'), 'featured_image');
        Storage::disk('images')->assertExists($path);

        $this->assertSame(
            $path,
            $this->imagesManager->getFeaturedImagePath()
        );

        $this->gameDeveloper->forceDelete();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_get_images_path(): void
    {
        $gameMedia = GameMedia::factory()->create();
        $imagesManager = app(ImagesManager::class, ['model' => $gameMedia]);

        $path1 = $imagesManager->add(UploadedFile::fake()->image('photo1.jpg'), 'images');
        $path2 = $imagesManager->add(UploadedFile::fake()->image('photo2.jpg'), 'images');

        $images = $imagesManager->getImagesPath();

        $this->assertContains($path1, $images);
        $this->assertContains($path2, $images);

        $gameMedia->forceDelete();
    }
}
