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

class HasThumbnailTest extends TestCase
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
    public function it_success_fake_upload_and_queue_thumbnail(): void
    {
        Queue::fake();
        Storage::fake('images');

        $gameDeveloper = GameDeveloperFactory::new()->create();

        $gameDeveloper->addImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg'),
            'thumbnail',
            ['small', 'medium']
        );

        if(config('thumbnail.driver') == 'media_library') {
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
    public function it_success_uploads_and_generate_thumbnail(): void
    {
        $gameDeveloper = GameDeveloperFactory::new()->create();

        $gameDeveloper->addImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg'),
            'thumbnail',
        );

        $this->assertDatabaseHas('media', [
            'model_id' => $gameDeveloper->id,
        ]);

        sleep(10);

        $path = $gameDeveloper->getThumbnailPath();

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
    public function it_success_queue_count_thumbnail_sizes(): void
    {
        Queue::fake();
        Storage::fake('images');

        $gameDeveloper = GameDeveloperFactory::new()->create();

        $gameDeveloper->addImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg'),
            'thumbnail'
        );

        Queue::assertPushed(GenerateThumbnailJob::class, 3);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, count($gameDeveloper->thumbnailSizes()));
    }

    /**
     * @test
     * @return void
     */
    public function it_success_update_uploads_and_generate_thumbnail(): void
    {
        Queue::fake();
        Storage::fake('images');

        $gameDeveloper = GameDeveloperFactory::new()->create();

        $gameDeveloper->addImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg'),
            'thumbnail',
        );

        $oldPath = $gameDeveloper->getThumbnailPath();

        $gameDeveloper->updateThumbnail(UploadedFile::fake()->image('photo1.jpg'), 'oldThumbnail');

        $gameDeveloperNewMedia = GameDeveloper::find($gameDeveloper->id)->first();
        $newPath = $gameDeveloperNewMedia->getThumbnailPath();

        $this->assertFalse($oldPath == $newPath);

//        $this->storage->assertMissing($oldPath);
//        $oldImagePathInfo = pathinfo($oldPath);
//        $this->storage->assertMissing($oldImagePathInfo['dirname']);
//
//        $path = $gameDeveloperNewMedia->getThumbnailPath();
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

        $gameDeveloper->addImageWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg'),
            'thumbnail',
        );

        $gameDeveloper->updateThumbnail('');

        $gameDeveloperNewMedia = GameDeveloper::find($gameDeveloper->id)->first();
        $newPath = $gameDeveloperNewMedia->getThumbnailPath();

        $this->assertEmpty($newPath);
    }
}
