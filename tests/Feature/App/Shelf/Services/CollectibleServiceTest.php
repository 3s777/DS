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
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Domain\Shelf\Services\CollectibleService;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
use Domain\Trade\Models\Auction;
use Domain\Trade\Models\Sale;
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
    protected Country $country;

    protected function setUp(): void
    {
        parent::setUp();

        $category = Category::factory()->create([
            'model' => Relation::getMorphAlias(GameMedia::class)
        ]);

        $this->request = CreateCollectibleGameRequest::factory()->hasKitConditions()->create(
            [
                'category_id' => $category->id,
            ]
        );

        $this->saleRequest = CreateCollectibleGameRequest::factory()->hasSale()->hasKitConditions()->create(
            [
                'category_id' => $category->id,
            ]
        );

        $this->user = User::factory()->create();
        $this->collector = Collector::factory()->create();
        $this->country = Country::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_collectible_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->assertDatabaseMissing('collectibles', [
            'name' => $this->request['name']
        ]);

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $gameService = app(CollectibleService::class);

        $this->request['target'] = 'collection';

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

        Queue::assertPushed(GenerateThumbnailJob::class, 3);
        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    /**
     * @test
     * @return void
     */
    public function it_collectible_with_auction_created_success(): void
    {
        $this->assertDatabaseMissing('collectibles', [
            'name' => $this->request['name']
        ]);

        $gameService = app(CollectibleService::class);

        $this->request['target'] = TargetEnum::Auction->value;
        $this->request['sale']['price'] = null;
        $this->request['auction']['price'] = '100';
        $this->request['auction']['step'] = '200';
        $this->request['auction']['finished_at'] = '2025-12-20';
        $this->request['shipping'] = ShippingEnum::Country->value;
        $this->request['country_id'] = $this->country->id;

        $gameService->create(FillCollectibleDTO::fromRequest(
            new Request($this->request)
        ));

        $this->assertDatabaseHas('collectibles', [
            'name' => $this->request['name']
        ]);

        $collectible = Collectible::where('name', $this->request['name'])->first();

        $this->assertNotNull($collectible->auction_data);
        $this->assertInstanceOf(Auction::class, $collectible->auction);
        $this->assertEquals($collectible->auction->price->value(), $collectible->auction_data->price()->value());
        $this->assertEquals($collectible->auction->step->value(), $collectible->auction_data->step()->value());
    }

    /**
     * @test
     * @return void
     */
    public function it_collectible_with_sale_created_success(): void
    {
        $this->assertDatabaseMissing('collectibles', [
            'name' => $this->request['name']
        ]);

        $gameService = app(CollectibleService::class);

//        $this->request['target'] = TargetEnum::Sale->value;
//        $this->request['sale']['price'] = 100;
//        $this->request['sale']['quantity'] = '2';
//        $this->request['sale']['reservation'] = ReservationEnum::None->value;
//        $this->request['shipping'] = ShippingEnum::Country->value;
        $this->saleRequest['country_id'] = $this->country->id;
//        $this->request['self_delivery'] = true;

        dump($this->country->id, $this->saleRequest['country_id']);

        $gameService->create(FillCollectibleDTO::fromRequest(
            new Request($this->saleRequest)
        ));

        $this->assertDatabaseHas('collectibles', [
            'name' => $this->saleRequest['name']
        ]);

        $collectible = Collectible::where('name', $this->saleRequest['name'])->first();

        $this->assertNotNull($collectible->sale_data);
        $this->assertInstanceOf(Sale::class, $collectible->sale);
        $this->assertEquals($collectible->sale->price->value(), $collectible->sale_data->price()->value());
        $this->assertEquals($collectible->sale->quantity, $collectible->sale_data->quantity());
        $this->assertTrue($collectible->sale->self_delivery);
        $this->assertTrue($collectible->sale_data->self_delivery());
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
        $this->request['target'] = TargetEnum::Sale->value;
        $this->request['shelf_id'] = $newShelf->id;
        $this->request['sale']['price'] = '100';
        $this->request['sale']['quantity'] = '1';
        $this->request['sale']['reservation'] = ReservationEnum::None->value;
        $this->request['shipping'] = ShippingEnum::Country->value;
        $this->request['country_id'] = $this->country->id;
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

    /**
     * @test
     * @return void
     */
    public function it_collectible_change_trade_target_updated_success(): void
    {
        $collectibleService = app(CollectibleService::class);

        $this->request['target'] = TargetEnum::Auction->value;
        $this->request['sale']['price'] = null;
        $this->request['auction']['price'] = '100';
        $this->request['auction']['step'] = '200';
        $this->request['auction']['finished_at'] = '2025-12-20';
        $this->request['shipping'] = ShippingEnum::Country->value;
        $this->request['country_id'] = $this->country->id;

        $collectibleService->create(FillCollectibleDTO::fromRequest(
            new Request($this->request)
        ));

        $collectible = Collectible::where('name', $this->request['name'])->first();

        $this->assertNotNull($collectible->auction_data);
        $this->assertInstanceOf(Auction::class, $collectible->auction);
        $this->assertNull($collectible->sale_data);
        $this->assertNull($collectible->sale);

        $this->request['name'] = 'NewNameCollectible';
        $this->request['collectable'] = 200;
        $this->request['target'] = TargetEnum::Sale->value;
        $this->request['sale']['price'] = '100';
        $this->request['sale']['price_old'] = '200.55';
        $this->request['sale']['quantity'] = '1';
        $this->request['sale']['reservation'] = ReservationEnum::None->value;
        $this->request['shipping'] = ShippingEnum::Country->value;
        $this->request['country_id'] = $this->country->id;
        $this->request['description'] = 'NewDescription';

        $collectibleService->update($collectible, FillCollectibleDTO::fromRequest(new Request($this->request)));

        $updatedCollectible= Collectible::where('name', 'NewNameCollectible')->first();

        $this->assertNull($updatedCollectible->auction_data);
        $this->assertNull($updatedCollectible->auction);

        $this->assertNotNull($updatedCollectible->sale_data);
        $this->assertInstanceOf(Sale::class, $updatedCollectible->sale);

        $this->assertEquals($updatedCollectible->sale->price->value(), $this->request['sale']['price']);
        $this->assertEquals('sale', $updatedCollectible->target);
        $this->assertNotEquals($updatedCollectible->collectable->id, $this->request['collectable']);

        $this->assertEquals($updatedCollectible->sale->price->value(), $updatedCollectible->sale_data->price()->value());
    }

    /**
     * @test
     * @return void
     */
    public function it_collectible_change_not_trade_target_updated_success(): void
    {
        $collectibleService = app(CollectibleService::class);

        $this->request['target'] = TargetEnum::Auction->value;
        $this->request['sale']['price'] = null;
        $this->request['auction']['price'] = '100';
        $this->request['auction']['step'] = '200';
        $this->request['auction']['finished_at'] = '2025-12-20';
        $this->request['shipping'] = ShippingEnum::Country->value;
        $this->request['country_id'] = $this->country->id;

        $collectibleService->create(FillCollectibleDTO::fromRequest(
            new Request($this->request)
        ));

        $collectible = Collectible::where('name', $this->request['name'])->first();

        $this->assertNotNull($collectible->auction_data);
        $this->assertInstanceOf(Auction::class, $collectible->auction);
        $this->assertNull($collectible->sale_data);
        $this->assertNull($collectible->sale);

        $this->request['target'] = TargetEnum::Collection->value;

        $collectibleService->update($collectible, FillCollectibleDTO::fromRequest(new Request($this->request)));

        $updatedCollectible= Collectible::find($collectible->id);

        $this->assertNull($updatedCollectible->auction_data);
        $this->assertNull($updatedCollectible->auction);

        $this->assertNull($updatedCollectible->sale_data);
        $this->assertNull($updatedCollectible->sale);
    }
}
