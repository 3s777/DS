<?php

namespace Support\Traits;

use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Factories\Game\GameDeveloperFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
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

    public function setUp(): void
    {
        parent::setUp();

        $this->storage = Storage::disk('images');
        $this->user = UserFactory::new()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_fake_upload_and_queue_featured_image(): void
    {
        Queue::fake();
        Storage::fake('images');

        $gameDeveloper = GameDeveloperFactory::new()->create();

        $gameDeveloper->addFeaturedImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg'),
            ['small', 'medium']
        );

        if(config('images.driver') == 'media_library') {
            $this->assertDatabaseHas('media', [
                'model_id' => $gameDeveloper->id,
            ]);
        }

        Queue::assertPushed(GenerateThumbnailJob::class, 3);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);

        $gameDeveloper->forceDelete();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_uploads_and_generate_featured_image(): void
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

        foreach($gameDeveloper->thumbnailSizes() as $thumb) {
            $this->storage->assertExists($imagePathInfo['dirname'].'/webp/'.$thumb[0].'x'.$thumb[1].'/'.$imagePathInfo['filename'].'.webp');
        }

        $gameDeveloper->forceDelete();

        $this->storage->assertMissing($path);
        $this->storage->assertMissing($imagePathInfo['dirname']);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_queue_count_featured_image_sizes(): void
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

    /**
     * @test
     * @return void
     */
    public function it_success_update_uploads_and_generate_featured_image(): void
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

        $this->assertFalse($oldPath == $newPath);

        //        $this->storage->assertMissing($oldPath);
        //        $oldImagePathInfo = pathinfo($oldPath);
        //        $this->storage->assertMissing($oldImagePathInfo['dirname']);
        //
        //        $path = $gameDeveloperNewMedia->getFeaturedImagePath();
        //
        //
        //        $imagePathInfo = pathinfo($path);
        //
        //        $this->storage->assertExists($path);
        //
        //        $this->storage->assertExists($imagePathInfo['dirname']);
        //
        //        $this->storage->assertExists($imagePathInfo['dirname'].'/'.$imagePathInfo['filename'].'.webp');
        //
        //        $this->storage->assertExists($imagePathInfo['dirname'].'/'.$imagePathInfo['filename'].'_fallback.'.$imagePathInfo['extension']);
        //
        //        foreach($gameDeveloperNewMedia->thumbnailSizes() as $thumb) {
        //            $this->storage->assertExists($imagePathInfo['dirname'].'/webp/'.$thumb[0].'x'.$thumb[1].'/'.$imagePathInfo['filename'].'.webp');
        //        }
        //
        //        $gameDeveloperNewMedia->forceDelete();
        //
        //        $this->storage->assertMissing($path);
        //        $this->storage->assertMissing($imagePathInfo['dirname']);
    }


    /**
     * @test
     * @return void
     */
    public function it_success_delete_uploads_thumbnail(): void
    {
        Queue::fake();
        Storage::fake('images');

        $gameDeveloper = GameDeveloperFactory::new()->create();

        $gameDeveloper->addFeaturedImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg')
        );

        $gameDeveloper->updateFeaturedImage('');

        $gameDeveloperNewMedia = GameDeveloper::find($gameDeveloper->id)->first();
        $newPath = $gameDeveloperNewMedia->getFeaturedImagePath();

        $this->assertEmpty($newPath);
    }
}
