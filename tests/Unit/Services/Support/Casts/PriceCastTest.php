<?php

namespace Services\Support\Casts;

use Database\Factories\Auth\UserFactory;
use Database\Factories\Shelf\CollectibleFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GameMediaVariation;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Enums\ShippingEnum;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Support\ValueObjects\PriceValueObject;
use Tests\TestCase;

class PriceCastTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Collectible $collectible;
    protected Category $category;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->category = Category::factory()->create(['model' => Relation::getMorphAlias(GameMediaVariation::class)]);
    }

    public function test_sale_success(): void
    {
        $gameMediaVariation = GameMediaVariation::factory()
            ->for(GameMedia::factory(), 'gameMedia')
            ->create();

        $attributes = [
                'collectable_type' => 'game_media_variation',
                'collectable_id' => $gameMediaVariation->id,
                'mediable_id' => $gameMediaVariation->game_media_id,
                'mediable_type' => 'game_media',
                'purchase_price' => 12.99
            ];

        $collectible = CollectibleFactory::new()->for(GameMedia::factory(), 'collectable')
            ->for($this->category)
            ->create($attributes);

        $this->assertInstanceOf(PriceValueObject::class, $collectible->purchase_price);
        $this->assertSame(1299, $collectible->purchase_price->raw());

        $collectible->purchase_price = 14.5989;

        $collectible->save();

        $this->assertInstanceOf(PriceValueObject::class, $collectible->purchase_price);
        $this->assertSame(1459, $collectible->purchase_price->raw());
    }
}
