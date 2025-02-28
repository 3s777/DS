<?php

namespace App\Shelf\Controllers;

use App\Http\Controllers\Shelf\Admin\CollectibleController;
use App\Http\Controllers\Shelf\Admin\CollectibleGameController;
use App\Http\Requests\Shelf\Admin\CreateCollectibleGameRequest;
use Database\Factories\Shelf\CollectibleFactory;
use Database\Factories\Trade\AuctionFactory;
use Database\Factories\Trade\SaleFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Settings\Models\Country;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
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

        $this->collectible = CollectibleFactory::new()
            ->for(GameMedia::factory(), 'collectable')
            ->for(Category::factory()->create([
                'model' => Relation::getMorphAlias(GameMedia::class)
            ]))
            ->create();

        if($this->collectible->target === 'sale') {
            SaleFactory::new()->for($this->collectible, 'collectible')->create();
        }

        if($this->collectible->target === 'auction') {
            AuctionFactory::new()->for($this->collectible, 'collectible')->create();
        }

        $this->request = CreateCollectibleGameRequest::factory()->hasKitConditions()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array  $params = [],
        array  $request = []
    ): void
    {
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
        $this->request['target'] = TargetEnum::Sale->value;
        $this->request['sale']['price'] = 100;
        $this->request['sale']['price_old'] = 200;
        $this->request['sale']['quantity'] = 1;
        $this->request['sale']['reservation'] = ReservationEnum::None->value;
        $this->request['country_id'] = Country::factory()->create()->id;
        $this->request['shipping'] = ShippingEnum::None->value;

        $this->actingAs($this->user)
            ->post(action([CollectibleGameController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.collectibles.index')
            ->assertSessionHas('helper_flash_message', __('collectible.created'));

        $collectible = Collectible::where('name', $this->request['name'])->first();
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
        $this->request['target'] = TargetEnum::Auction->value;
        $this->request['auction']['price'] = '100';
        $this->request['auction']['step'] = '200';
        $this->request['auction']['finished_at'] = '2025-12-20';
        $this->request['shipping'] = ShippingEnum::Country->value;
        $this->request['country_id'] = Country::factory()->create()->id;

        $this->actingAs($this->user)
            ->post(action([CollectibleGameController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.collectibles.index')
            ->assertSessionHas('helper_flash_message', __('collectible.created'));

        $collectible = Collectible::where('name', $this->request['name'])->first();
        $auction = $collectible->auction;

        $this->actingAs($this->user)
            ->delete(action([CollectibleController::class, 'destroy'], [$collectible]))
            ->assertRedirectToRoute('admin.collectibles.index')
            ->assertSessionHas('helper_flash_message', __('collectible.deleted'));

        $this->assertSoftDeleted($collectible);
        $this->assertSoftDeleted($auction);
    }
}
