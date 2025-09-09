<?php

namespace Support\Traits;

use App\Jobs\Support\GenerateSmallThumbnailsJob;
use App\Jobs\Support\GenerateThumbnailJob;
use Database\Factories\Auth\UserFactory;
use Database\Factories\Game\GameDeveloperFactory;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HasFeaturedImageTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected GameDeveloper $gameDeveloper;
    protected array $request;
    protected Filesystem $storage;

    public function setUp(): void
    {
        parent::setUp();

        $this->storage = Storage::disk('images');
        $this->user = UserFactory::new()->create();
    }

    public function test_success_fake_upload_and_queue_featured_image(): void
    {
        Queue::fake();
        Storage::fake('images');

        $gameDeveloper = GameDeveloperFactory::new()->create();

        $gameDeveloper->addFeaturedImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg'),
            ['small', 'medium']
        );

        if (config('images.driver') == 'media_library') {
            $this->assertDatabaseHas('media', [
                'model_id' => $gameDeveloper->id,
            ]);
        }

        Queue::assertPushed(GenerateThumbnailJob::class, 3);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);

        $gameDeveloper->forceDelete();
    }

    public function test_success_get_featured_image_path(): void
    {
        Storage::fake('images');

        $gameDeveloper = GameDeveloperFactory::new()->create();

        $gameDeveloper->addFeaturedImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg')
        );

        $path = $gameDeveloper->getFeaturedImagePath();
        $pathWebp = $gameDeveloper->getFeaturedImagePathWebp();
        $imagePathInfo = pathinfo($path);

        $this->assertSame($gameDeveloper->imagesDir().'/'.date('Y').'/'.date('m').'/'.$imagePathInfo['filename'].'/'.$imagePathInfo['filename'].'.jpg', $path);

        $this->assertSame($imagePathInfo['dirname'].'/'.$imagePathInfo['filename'].'.webp', $pathWebp);
    }

    public function test_success_uploads_and_generate_featured_image(): void
    {
        $gameDeveloper = GameDeveloperFactory::new()->create();

        $gameDeveloper->addFeaturedImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg')
        );

        $this->assertDatabaseHas('media', [
            'model_id' => $gameDeveloper->id,
        ]);

        sleep(10);

        $path = $gameDeveloper->getFeaturedImagePath();

        $imagePathInfo = pathinfo($path);

        $this->storage->assertExists($path);

        $this->storage->assertExists($imagePathInfo['dirname']);

        $this->storage->assertExists($imagePathInfo['dirname'].'/'.$imagePathInfo['filename'].'.webp');

        $this->storage->assertExists($imagePathInfo['dirname'].'/'.$imagePathInfo['filename'].'_fallback.'.$imagePathInfo['extension']);

        foreach ($gameDeveloper->thumbnailSizes() as $thumb) {
            $this->storage->assertExists($imagePathInfo['dirname'].'/webp/'.$thumb[0].'x'.$thumb[1].'/'.$imagePathInfo['filename'].'.webp');
        }

        $gameDeveloper->forceDelete();

        $this->storage->assertMissing($path);
        $this->storage->assertMissing($imagePathInfo['dirname']);
    }

    public function test_success_queue_count_featured_image_sizes(): void
    {
        Queue::fake();
        Storage::fake('images');

        $gameDeveloper = GameDeveloperFactory::new()->create();

        $gameDeveloper->addFeaturedImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg')
        );

        Queue::assertPushed(GenerateThumbnailJob::class, 3);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, count($gameDeveloper->thumbnailSizes()));
    }

    public function test_success_update_uploads_and_generate_featured_image(): void
    {
        Queue::fake();
        Storage::fake('images');

        $gameDeveloper = GameDeveloperFactory::new()->create();

        $gameDeveloper->addFeaturedImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg')
        );

        $oldPath = $gameDeveloper->getFeaturedImagePath();

        $gameDeveloper->updateFeaturedImage(UploadedFile::fake()->image('photo1.jpg'), 'oldFeaturedImage');

        $gameDeveloperNewMedia = GameDeveloper::find($gameDeveloper->id)->first();
        $newPath = $gameDeveloperNewMedia->getFeaturedImagePath();

        $this->assertNotSame($oldPath, $newPath);
    }


    public function test_success_delete_uploads_with_empty_update_thumbnail(): void
    {
        Queue::fake();
        Storage::fake('images');

        $gameDeveloper = GameDeveloperFactory::new()->create();

        $gameDeveloper->addFeaturedImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg')
        );

        $gameDeveloper->updateFeaturedImage(null, false);

        $gameDeveloperNewMedia = GameDeveloper::find($gameDeveloper->id)->first();
        $newPath = $gameDeveloperNewMedia->getFeaturedImagePath();

        $this->assertEmpty($newPath);
    }

    public function test_success_delete_uploads_thumbnail(): void
    {
        Queue::fake();
        Storage::fake('images');

        $gameDeveloper = GameDeveloperFactory::new()->create();

        $gameDeveloper->addFeaturedImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg')
        );

        $gameDeveloper->deleteFeaturedImage();

        $gameDeveloperNewMedia = GameDeveloper::find($gameDeveloper->id)->first();
        $newPath = $gameDeveloperNewMedia->getFeaturedImagePath();

        $this->assertEmpty($newPath);
    }
}
