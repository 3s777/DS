<?php

namespace App\Shelf\Controllers;

use App\Http\Controllers\Shelf\Admin\CollectibleController;
use App\Http\Controllers\Shelf\Admin\CollectibleGameController;
use App\Http\Requests\Shelf\Admin\CreateCollectibleGameRequest;
use Database\Factories\Auth\UserFactory;
use Database\Factories\Shelf\CollectibleFactory;
use Database\Factories\Trade\AuctionFactory;
use Database\Factories\Trade\SaleFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GameMediaVariation;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollectibleControllerTest extends TestCase
{
    use RefreshDatabase;

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

        if ($this->collectible->target === 'sale') {
            SaleFactory::new()->for($this->collectible, 'collectible')->create();
        }

        if ($this->collectible->target === 'auction') {
            AuctionFactory::new()->for($this->collectible, 'collectible')->create();
        }

        $this->request = CreateCollectibleGameRequest::factory()->hasKitConditions()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array  $params = [],
        array  $request = []
    ): void {
        $this->{$method}(action([CollectibleController::class, $action], $params), $request)
            ->assertRedirectToRoute('admin.login');
    }

    /**
     * @test
     * @return void
     */
    public function it_pages_success(): void
    {
        $this->checkNotAuthRedirect('index');
        $this->checkNotAuthRedirect('edit', 'get', [$this->collectible->id]);
    }

    /**
     * @test
     * @return void
     */
    public function it_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([CollectibleController::class, 'index']))
            ->assertOk()
            ->assertSee(__('collectible.list'))
            ->assertViewIs('admin.shelf.collectible.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_success(): void
    {
        $class = Relation::getMorphedModel($this->collectible->collectable->getMorphClass());
        $type = strtolower(CollectibleTypeEnum::tryFrom($class)->name);

        $this->actingAs($this->user)
            ->get(action([CollectibleController::class, 'edit'], [$this->collectible->id]))
            ->assertOk()
            ->assertSee($this->collectible->name)
            ->assertViewIs('admin.shelf.collectible.'.$type.'.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_success(): void
    {
        $this->actingAs($this->user)
            ->delete(action([CollectibleController::class, 'destroy'], [$this->collectible->id]))
            ->assertRedirectToRoute('admin.collectibles.index')
            ->assertSessionHas('helper_flash_message', __('collectible.deleted'));

        $this->assertSoftDeleted($this->collectible);
    }

    /**
     * @test
     * @return void
     */
    public function it_deleted_with_sale_success(): void
    {
        $request = CreateCollectibleGameRequest::factory()->hasSale()->hasKitConditions()->create();

        $this->actingAs($this->user)
            ->post(action([CollectibleGameController::class, 'store']), $request)
            ->assertRedirectToRoute('admin.collectibles.index')
            ->assertSessionHas('helper_flash_message', __('collectible.created'));

        $collectible = Collectible::where('name', $request['name'])->first();
        $sale = $collectible->sale;

        $this->actingAs($this->user)
            ->delete(action([CollectibleController::class, 'destroy'], [$collectible]))
            ->assertRedirectToRoute('admin.collectibles.index')
            ->assertSessionHas('helper_flash_message', __('collectible.deleted'));

        $this->assertSoftDeleted($collectible);
        $this->assertSoftDeleted($sale);
    }

    /**
     * @test
     * @return void
     */
    public function it_deleted_with_auction_success(): void
    {
        $request = CreateCollectibleGameRequest::factory()->hasAuction()->hasKitConditions()->create();

        $this->actingAs($this->user)
            ->post(action([CollectibleGameController::class, 'store']), $request)
            ->assertRedirectToRoute('admin.collectibles.index')
            ->assertSessionHas('helper_flash_message', __('collectible.created'));

        $collectible = Collectible::where('name', $request['name'])->first();
        $auction = $collectible->auction;

        $this->actingAs($this->user)
            ->delete(action([CollectibleController::class, 'destroy'], [$collectible]))
            ->assertRedirectToRoute('admin.collectibles.index')
            ->assertSessionHas('helper_flash_message', __('collectible.deleted'));

        $this->assertSoftDeleted($collectible);
        $this->assertSoftDeleted($auction);
    }
}
