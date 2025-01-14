<?php

namespace Feature\Support\Traits;

use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use App\Models\Media;
use Database\Factories\Game\GameDeveloperFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\Collectible;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HasImagesTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected GameMedia $gameMedia;
    protected array $request;
    protected Filesystem $storage;

    public function setUp(): void
    {
        parent::setUp();

        $this->storage = Storage::disk('images');
        $this->user = UserFactory::new()->create();
        $this->gameMedia = GameMedia::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_add_images_with_thumbnails(): void
    {
        Queue::fake();

        $path1 = $this->gameMedia->addImagesWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg'),
            ['small', 'medium']
        );

        $path2 = $this->gameMedia->addImagesWithThumbnail(
            UploadedFile::fake()->image('photo2.jpg'),
            ['small', 'medium']
        );

        $this->storage->assertExists($path1);

        $this->storage->assertExists($path2);

        Queue::assertPushed(GenerateThumbnailJob::class, 6);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 4);

        $this->gameMedia->forceDelete();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_delete_images(): void
    {
        $path1 = $this->gameMedia->addImagesWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg'),
            ['small', 'medium']
        );

        $path2 = $this->gameMedia->addImagesWithThumbnail(
            UploadedFile::fake()->image('photo2.jpg'),
            ['small', 'medium']
        );

        $this->storage->assertExists($path1);

        $this->storage->assertExists($path2);

        $this->gameMedia->deleteImages($path1.','.$path2);

        $this->storage->assertMissing($path1);

        $this->storage->assertMissing($path2);

        $this->gameMedia->forceDelete();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_get_images(): void
    {
        $path1 = $this->gameMedia->addImagesWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg'),
            ['small', 'medium']
        );

        $path2 = $this->gameMedia->addImagesWithThumbnail(
            UploadedFile::fake()->image('photo2.jpg'),
            ['small', 'medium']
        );

        $this->assertEquals($this->gameMedia->getImages(), [$path1, $path2]);

        $this->gameMedia->forceDelete();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_update_images(): void
    {
        $path1 = $this->gameMedia->addImagesWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg'),
            ['small', 'medium']
        );

        $path2 = $this->gameMedia->addImagesWithThumbnail(
            UploadedFile::fake()->image('photo2.jpg'),
            ['small', 'medium']
        );

        $this->gameMedia->updateImages([UploadedFile::fake()->image('photo3.jpg'), UploadedFile::fake()->image('photo4.jpg')], null, ['small', 'medium']);

        $this->assertEquals(count($this->gameMedia->getImages()), 4);

        $this->gameMedia->forceDelete();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_update_images_with_delete(): void
    {
        $gameMedia = GameMedia::factory()->create();
        $path1 = $gameMedia->addImagesWithThumbnail(
            UploadedFile::fake()->image('photo1.jpg'),
            ['small', 'medium']
        );

        $path2 = $gameMedia->addImagesWithThumbnail(
            UploadedFile::fake()->image('photo2.jpg'),
            ['small', 'medium']
        );

        $gameMedia->updateImages(
            [UploadedFile::fake()->image('photo3.jpg'), UploadedFile::fake()->image('photo4.jpg'), UploadedFile::fake()->image('photo5.jpg')],
            $path1.','.$path2,
            ['small', 'medium']
        );

        $gameMedia = GameMedia::find($gameMedia->id);

//        dd(Media::all(), $gameMedia->getImages(), $path1, $path2, $gameMedia->images, $gameMedia->getMedia('images'));

//        dd($path1, $path2, $this->gameMedia->getImages());

        $this->assertEquals(count($gameMedia->getImages()), 3);

        $this->gameMedia->forceDelete();
    }
}
