<?php

namespace Admin\Shelf\Services;

use Admin\Shelf\DTOs\FillKitItemDTO;
use App\Admin\Http\Requests\Shelf\CreateKitItemRequest;
use Domain\Auth\Models\User;
use Domain\Shelf\Models\KitItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
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

    public function test_kit_item_created_success(): void
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

    public function test_kit_item_updated_success(): void
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

        $this->assertSame($updatedKitItem->slug, $this->request['slug']);
    }
}
