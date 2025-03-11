<?php

namespace App\Shelf\Casts;

use Database\Factories\Shelf\CollectibleFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Settings\Models\Country;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Enums\ShippingEnum;
use Domain\Trade\ValueObjects\AuctionValueObject;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Support\ValueObjects\PriceValueObject;
use Tests\TestCase;

class AuctionCastTest extends TestCase
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

        $this->category = Category::factory()->create(['model' => Relation::getMorphAlias(GameMedia::class)]);
    }

    /**
     * @test
     * @return void
     */
    public function it_auction_success():void
    {
        $country = Country::factory()->create();
        $collectible = CollectibleFactory::new()->for(GameMedia::factory(), 'collectable')
            ->for($this->category)
            ->create(
                [
                    'auction_data' => [
                        'price' => 10.099,
                        'step' => 05.11,
                        'finished_at' => '2024-02-13T10:10',
                        'country_id' => $country->id,
                        'shipping' => ShippingEnum::None->value,
                    ]
                ]
            );

        $this->assertInstanceOf(AuctionValueObject::class, $collectible->auction_data);
        $this->assertInstanceOf(PriceValueObject::class, $collectible->auction_data->price());
        $this->assertInstanceOf(PriceValueObject::class, $collectible->auction_data->step());
        $this->assertNotEmpty($collectible->auction_data->finished_at());
        $this->assertSame(1009, $collectible->auction_data->price()->raw());
        $this->assertFalse($collectible->auction_data->self_delivery());
        $this->assertSame($collectible->auction_data->country_id(), $country->id);

        $collectible->auction_data = [
            'price' => 14.5989,
            'step' => 55.9888,
            'finished_at' => '2025-02-13',
            'blitz' => 963,
            'test' => 'wrong parameter',
            'country_id' => $country->id,
            'shipping' => ShippingEnum::None->value,
            'self_delivery' => true
        ];

        $collectible->save();

        $this->assertInstanceOf(AuctionValueObject::class, $collectible->auction_data);
        $this->assertInstanceOf(PriceValueObject::class, $collectible->auction_data->price());
        $this->assertInstanceOf(PriceValueObject::class, $collectible->auction_data->step());
        $this->assertInstanceOf(PriceValueObject::class, $collectible->auction_data->blitz());
        $this->assertSame(1459, $collectible->auction_data->price()->raw());
        $this->assertSame(5598, $collectible->auction_data->step()->raw());
        $this->assertSame(96300, $collectible->auction_data->blitz()->raw());
        $this->assertTrue($collectible->auction_data->self_delivery());

        $rawAuction = json_decode($collectible->getRawOriginal('auction_data'), true);
        $this->assertSame(8, count($rawAuction));
    }
}
