<?php

namespace App\Shelf\Services;

use App\Http\Requests\Shelf\Admin\CreateCollectibleGameRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Settings\Models\Country;
use Domain\Shelf\DTOs\FillCollectibleDTO;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Domain\Shelf\Services\CollectibleService;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CollectibleServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;
    protected User $user;
    protected Collector $collector;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = CreateCollectibleGameRequest::factory()->hasKitConditions()->create(
            [
                'category_id' => Category::factory()->create([
                    'model' => Relation::getMorphAlias(GameMedia::class)
                ])->id,
            ]
        );

        $this->user = User::factory()->create();
        $this->collector = Collector::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_collectible_created_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->assertDatabaseMissing('collectibles', [
            'name' => $this->request['name']
        ]);

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $gameService = app(CollectibleService::class);

        $this->request['target'] = 'auction';
        $this->request['sale']['price'] = null;
        $this->request['auction']['price'] = '100';
        $this->request['auction']['step'] = '200';
        $this->request['auction']['finished_at'] = '2025-12-20';
        $this->request['shipping'] = ShippingEnum::Country->value;
        $this->request['country_id'] = Country::factory()->create()->id;

        $gameService->create(FillCollectibleDTO::fromRequest(
            new Request($this->request)
        ));

        $this->assertDatabaseHas('collectibles', [
            'name' => $this->request['name']
        ]);

        $collectible = Collectible::where('name', $this->request['name'])->first();

        $shelf = Shelf::find($this->request['shelf_id']);

        $this->assertEquals($collectible->shelf, $shelf);
        $this->assertEquals($collectible->collector->id, $shelf->collector->id);
        $this->assertEquals($collectible->collectable->id, $this->request['collectable']);
        $this->assertEquals($collectible->auction->price->value(), $collectible->auction_data->price()->value());
        $this->assertEquals($collectible->auction->step->value(), $collectible->auction_data->step()->value());


        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    /**
     * @test
     * @return void
     */
    public function it_collectible_updated_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $collectibleService = app(CollectibleService::class);

        $collectibleService->create(FillCollectibleDTO::fromRequest(
            new Request($this->request)
        ));

        $collectible = Collectible::where('name', $this->request['name'])->first();

        $newShelf = Shelf::factory()->create();

        $this->request['name'] = 'NewNameCollectible';
        $this->request['collectable'] = 200;
        $this->request['target'] = 'sale';
        $this->request['shelf_id'] = $newShelf->id;
        $this->request['sale']['price'] = '100';
        $this->request['sale']['quantity'] = '1';
        $this->request['sale']['reservation'] = ReservationEnum::None->value;
        $this->request['shipping'] = ShippingEnum::Country->value;
        $this->request['country_id'] = Country::factory()->create()->id;
        $this->request['description'] = 'NewDescription';
        $this->request['featured_image'] = UploadedFile::fake()->image('photo2.jpg');

        $collectibleService->update($collectible, FillCollectibleDTO::fromRequest(new Request($this->request)));

        $this->assertDatabaseHas('collectibles', [
            'name' => 'NewNameCollectible',
        ]);

        $updatedCollectible= Collectible::where('name', 'NewNameCollectible')->first();

        $this->assertEquals($updatedCollectible->sale->price->value(), $this->request['sale']['price']);
        $this->assertEquals($updatedCollectible->target, $this->request['target']);
        $this->assertEquals($updatedCollectible->shelf->id, $newShelf->id);
        $this->assertEquals($updatedCollectible->collector->id, $newShelf->collector->id);
        $this->assertNotEquals($updatedCollectible->collectable->id, $this->request['collectable']);

        $this->assertEquals($updatedCollectible->sale->price->value(), $updatedCollectible->sale_data->price()->value());

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }
}
