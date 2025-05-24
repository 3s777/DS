<?php

namespace App\Shelf\Controllers;

use App\Http\Controllers\Shelf\Admin\CollectibleGameController;
use App\Http\Requests\Shelf\Admin\CreateCollectibleGameRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Factories\Auth\UserFactory;
use Database\Factories\Shelf\CollectibleFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GameMediaVariation;
use Domain\Settings\Models\Country;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CollectibleGameControllerTest extends TestCase
{
    use RefreshDatabase;
    //    use DatabaseTruncation;

    protected User $user;
    protected Collectible $collectible;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $gameMediaVariation = GameMediaVariation::factory()
            ->for(GameMedia::factory(), 'gameMedia')
            ->create();

        $this->collectible = CollectibleFactory::new()
            ->for(Category::factory()->create([
                'model' => Relation::getMorphAlias(GameMediaVariation::class)
            ]))
            ->create(
                [
                    'collectable_type' => 'game_media_variation',
                    'collectable_id' => $gameMediaVariation->id,
                    'mediable_id' => $gameMediaVariation->game_media_id,
                    'mediable_type' => 'game_media',
                ]
            );

        $this->request = CreateCollectibleGameRequest::factory()->hasKitConditions()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array  $params = [],
        array  $request = []
    ): void {
        $this->{$method}(action([CollectibleGameController::class, $action], $params), $request)
            ->assertRedirectToRoute('admin.login');
    }

    private function setFakeRequestData(): void
    {
        $this->request['name'] = '';
        $this->request['article_number'] = ['fake', 'fake 2'];
        $this->request['condition'] = 'fake';
        $this->request['purchase_price'] = 'fake';
        $this->request['seller'] = ['fake'];
        $this->request['purchased_at'] = 22;
        $this->request['additional_field'] = ['fake'];
        $this->request['properties']['is_done'] = 'fake';
        $this->request['properties']['is_digital'] = 'fake';
        $this->request['collectable'] = 150000;
        $this->request['kit_conditions'] = null;
        $this->request['target'] = 'fake';
        $this->request['shelf_id'] = 1500000;
    }

    private function setFakeSaleRequestData(): void
    {
        $this->request['target'] = 'sale';
        $this->request['sale']['price'] = 'fake';
        $this->request['sale']['price_old'] = 'fake';
        $this->request['sale']['quantity'] = 'fake';
        $this->request['sale']['bidding'] = 'fake';
        $this->request['sale']['reservation'] = 'fake';
        $this->request['shipping'] = 'fake';
        $this->request['self_delivery'] = 'fake';
        $this->request['country_id'] = 'fake';
    }

    private function setFakeAuctionRequestData(): void
    {
        $this->request['target'] = 'auction';
        $this->request['auction']['price'] = 'fake';
        $this->request['auction']['step'] = 'fake';
        $this->request['auction']['finished_at'] = 'fake';
        $this->request['auction']['blitz'] = 'fake';
        $this->request['auction']['renewal'] = 'fake';
        $this->request['shipping'] = 'fake';
        $this->request['self_delivery'] = 'fake';
        $this->request['country_id'] = 'fake';
    }

    /**
     * @test
     * @return void
     */
    public function it_pages_success(): void
    {
        //        $this->checkNotAuthRedirect('index');
        $this->checkNotAuthRedirect('create');
        //        $this->checkNotAuthRedirect('edit', 'get', [$this->collectible->slug]);
        $this->checkNotAuthRedirect('store', 'post', $this->request);
        $this->checkNotAuthRedirect('update', 'put', [$this->collectible->id], $this->request);
    }

    //    /**
    //     * @test
    //     * @return void
    //     */
    //    public function it_index_success(): void
    //    {
    //        $this->actingAs($this->user)
    //            ->get(action([GameMediaController::class, 'index']))
    //            ->assertOk()
    //            ->assertSee(__('game.media.list'))
    //            ->assertViewIs('admin.game.media.index');
    //    }

    /**
     * @test
     * @return void
     */
    public function it_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([CollectibleGameController::class, 'create']))
            ->assertOk()
            ->assertSee(__('collectible.add'))
            ->assertViewIs('admin.shelf.collectible.game.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {
        $this->actingAs($this->user)
            ->post(action([CollectibleGameController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.collectibles.index')
            ->assertSessionHas('helper_flash_message', __('collectible.created'));

        $this->assertDatabaseHas('collectibles', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_store_with_image_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $this->actingAs($this->user)
            ->post(action([CollectibleGameController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.collectibles.index')
            ->assertSessionHas('helper_flash_message', __('collectible.created'));

        $this->assertDatabaseHas('collectibles', [
            'name' => $this->request['name']
        ]);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_create_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.collectibles.create.game'));

        $this->setFakeRequestData();

        $this->actingAs($this->user)
            ->post(action([CollectibleGameController::class, 'store']), $this->request)
            ->assertInvalid([
                'name',
                'article_number',
                'condition',
                'purchase_price',
                'seller',
                'purchased_at',
                'additional_field',
                'properties.is_done',
                'properties.is_digital',
                'collectable',
                'kit_conditions',
                'target',
                'shelf_id'
            ])
            ->assertRedirectToRoute('admin.collectibles.create.game');

        $this->setFakeSaleRequestData();

        $this->actingAs($this->user)
            ->post(action([CollectibleGameController::class, 'store']), $this->request)
            ->assertInvalid([
                'sale.price',
                'sale.price_old',
                'sale.quantity',
                'sale.bidding',
                'sale.reservation',
                'country_id',
                'shipping',
                'self_delivery'
            ])
            ->assertRedirectToRoute('admin.collectibles.create.game');

        $this->setFakeAuctionRequestData();

        $this->actingAs($this->user)
            ->post(action([CollectibleGameController::class, 'store']), $this->request)
            ->assertInvalid([
                'auction.price',
                'auction.step',
                'auction.finished_at',
                'auction.blitz',
                'auction.renewal',
                'country_id',
                'shipping',
                'self_delivery'
            ])
            ->assertRedirectToRoute('admin.collectibles.create.game');

        $this->assertDatabaseMissing('collectibles', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_update_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.collectibles.create.game'));

        $this->setFakeRequestData();

        $this->actingAs($this->user)
            ->put(
                action(
                    [CollectibleGameController::class, 'update'],
                    [$this->collectible->id]
                ),
                $this->request
            )
            ->assertInvalid([
                'name',
                'article_number',
                'condition',
                'purchase_price',
                'seller',
                'purchased_at',
                'additional_field',
                'properties.is_done',
                'properties.is_digital',
                'kit_conditions',
                'target',
                'shelf_id'
            ])
            ->assertRedirectToRoute('admin.collectibles.create.game');

        $this->setFakeSaleRequestData();

        $this->actingAs($this->user)
            ->put(
                action(
                    [CollectibleGameController::class, 'update'],
                    [$this->collectible->id]
                ),
                $this->request
            )
            ->assertInvalid([
                'sale.price',
                'sale.price_old',
                'sale.bidding',
                'sale.reservation',
                'country_id',
                'shipping',
                'self_delivery'
            ])
            ->assertRedirectToRoute('admin.collectibles.create.game');

        $this->setFakeAuctionRequestData();

        $this->actingAs($this->user)
            ->put(
                action(
                    [CollectibleGameController::class, 'update'],
                    [$this->collectible->id]
                ),
                $this->request
            )
            ->assertInvalid([
                'auction.price',
                'auction.step',
                'auction.finished_at',
                'auction.blitz',
                'auction.renewal',
                'country_id',
                'shipping',
                'self_delivery'
            ])
            ->assertRedirectToRoute('admin.collectibles.create.game');

        $this->assertDatabaseMissing('collectibles', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_featured_image_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.collectibles.create.game'));

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.php');

        $this->actingAs($this->user)
            ->post(action([CollectibleGameController::class, 'store']), $this->request)
            ->assertInvalid(['featured_image'])
            ->assertRedirectToRoute('admin.collectibles.create.game');
    }

    /**
     * @test
     * @return void
     */
    public function it_update_success(): void
    {
        $newShelf = Shelf::factory()->create();

        $this->request['name'] = 'newName';
        $this->request['article_number'] = 'newNumber';
        $this->request['condition'] = 'new';
        $this->request['purchase_price'] = 100;
        $this->request['seller'] = 'seller';
        $this->request['purchased_at'] = '2023-01-03';
        $this->request['additional_field'] = 'additional';
        $this->request['properties']['is_done'] = true;
        $this->request['properties']['is_digital'] = true;
        $this->request['collectable'] = 200;
        $this->request['target'] = 'sale';
        $this->request['shelf_id'] = $newShelf->id;
        $this->request['sale']['price'] = 100;
        $this->request['sale']['price_old'] = 200;
        $this->request['sale']['quantity'] = 1;
        $this->request['sale']['reservation'] = ReservationEnum::None->value;
        $this->request['country_id'] = Country::factory()->create()->id;
        $this->request['shipping'] = ShippingEnum::None->value;

        $this->actingAs($this->user)
            ->put(
                action(
                    [CollectibleGameController::class, 'update'],
                    [$this->collectible->id]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.collectibles.index')
            ->assertSessionHas('helper_flash_message', __('collectible.updated'));

        $updatedCollectible = Collectible::find($this->collectible->id);

        $this->assertSame(
            [
                $updatedCollectible->name,
                $updatedCollectible->article_number,
                $updatedCollectible->condition,
                $updatedCollectible->purchase_price->value(),
                $updatedCollectible->seller,
                $updatedCollectible->purchased_at,
                $updatedCollectible->additional_field,
                $updatedCollectible->properties['is_done'],
                $updatedCollectible->properties['is_digital'],
                $updatedCollectible->target,
                $updatedCollectible->shelf_id,
                $updatedCollectible->sale->price->value(),
                $updatedCollectible->sale->price_old->value()
            ],
            [
                $this->request['name'],
                $this->request['article_number'],
                $this->request['condition'],
                $this->request['purchase_price'],
                $this->request['seller'],
                $this->request['purchased_at'],
                $this->request['additional_field'],
                $this->request['properties']['is_done'],
                $this->request['properties']['is_digital'],
                $this->request['target'],
                $this->request['shelf_id'],
                $this->request['sale']['price'],
                $this->request['sale']['price_old'],
            ]
        );
    }
}
