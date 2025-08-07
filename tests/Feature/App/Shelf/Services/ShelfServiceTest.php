<?php

namespace App\Shelf\Services;

use App\Http\Requests\Auth\Admin\CreateAdminRequest;
use App\Http\Requests\Shelf\Admin\CreateShelfRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\User;
use Domain\Shelf\DTOs\FillShelfDTO;
use Domain\Shelf\Models\Shelf;
use Domain\Shelf\Services\ShelfService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ShelfServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;
    protected User $user;
    protected Collector $collector;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateShelfRequest::factory()->create();

        $this->user = User::factory()->create();
        $this->collector = Collector::factory()->create();
    }

    public function test_shelf_created_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->assertDatabaseMissing('shelves', [
            'name' => $this->request['name']
        ]);

        $this->request['collector_id'] = $this->collector->id;
        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $request = new Request($this->request);

        $gameService = app(ShelfService::class);

        $gameService->create(FillShelfDTO::fromRequest(
            $request
        ));

        $this->assertDatabaseHas('shelves', [
            'name' => $this->request['name']
        ]);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }


    public function test_shelf_updated_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->request['collector_id'] = $this->collector->id;

        $createRequest = new Request($this->request);

        $shelfService = app(ShelfService::class);

        $shelfService->create(FillShelfDTO::fromRequest(
            $createRequest
        ));

        $shelf = Shelf::where('name', $this->request['name'])->first();

        $this->request['name'] = 'NewNameShelf';
        $this->request['number'] = 10;
        $this->request['description'] = 'NewDescription';
        $this->request['featured_image'] = UploadedFile::fake()->image('photo2.jpg');

        $updateRequest = new CreateAdminRequest($this->request);

        $shelfService->update($shelf, FillShelfDTO::fromRequest($updateRequest));

        $this->assertDatabaseHas('shelves', [
            'name' => 'NewNameShelf',
        ]);

        $updatedShelf = Shelf::where('name', 'NewNameShelf')->first();

        $this->assertSame($updatedShelf->number, $this->request['number']);
        $this->assertSame($updatedShelf->description, $this->request['description']);
        $this->assertNotNull($updatedShelf->ulid);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }
}
