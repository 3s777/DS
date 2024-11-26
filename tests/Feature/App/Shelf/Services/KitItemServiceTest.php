<?php

namespace App\Shelf\Services;

use App\Http\Requests\Auth\User\CreateUserRequest;

use App\Http\Requests\Shelf\CreateKitItemRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Domain\Auth\Models\User;
use Domain\Shelf\DTOs\FillKitItemDTO;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Services\KitItemService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class KitItemServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateKitItemRequest::factory()->create();

        $this->user = User::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_kit_item_created_success(): void
    {
        $this->assertDatabaseMissing('kit_items', [
            'slug' => Str::slug($this->request['name'])
        ]);

        $request = new Request($this->request);

        $kitItemService = app(KitItemService::class);

        $kitItemService->create(FillKitItemDTO::fromRequest(
            $request
        ));

        $this->assertDatabaseHas('kit_items', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_kit_item_updated_success(): void
    {

        $createRequest = new Request($this->request);

        $kitItemService = app(KitItemService::class);

        $kitItemService->create(FillKitItemDTO::fromRequest(
            $createRequest
        ));

        $kitItem = KitItem::where('slug', Str::slug($this->request['name']))->first();

        $this->request['name'] = 'NewNameGame';
        $this->request['slug'] = 'newslug';

        $updateRequest = new Request($this->request);

        $kitItemService->update($kitItem, FillKitItemDTO::fromRequest($updateRequest));

        $this->assertDatabaseHas('kit_items', [
            'slug' => 'newslug',
        ]);

        $updatedKitItem = KitItem::where('slug', 'newslug')->first();

        $this->assertTrue($updatedKitItem->slug == $this->request['slug']);
    }
}
