<?php

namespace App\Shelf\Casts;

use Database\Factories\Shelf\CollectibleFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
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
    public function it_sale_success():void
    {
        $collectible = CollectibleFactory::new()->for(GameMedia::factory(), 'collectable')
            ->for($this->category)
            ->create(
                [
                    'auction_data' => [
                        'price' => 10.099,
                        'step' => 05.11,
                        'finished_at' => '2024-02-13'
                    ]
                ]
            );

        $this->assertInstanceOf(AuctionValueObject::class, $collectible->auction_data);
        $this->assertInstanceOf(PriceValueObject::class, $collectible->auction_data->price());
        $this->assertInstanceOf(PriceValueObject::class, $collectible->auction_data->step());
        $this->assertNotEmpty($collectible->auction_data->finished_at());
        $this->assertEquals(1009, $collectible->auction_data->price()->raw());

        $collectible->auction_data = [
            'price' => 14.5989,
            'step' => 55.9888,
            'finished_at' => '2025-02-13',
            'test' => 'wrong parameter'
        ];

        $collectible->save();

        $this->assertInstanceOf(AuctionValueObject::class, $collectible->auction_data);
        $this->assertInstanceOf(PriceValueObject::class, $collectible->auction_data->price());
        $this->assertInstanceOf(PriceValueObject::class, $collectible->auction_data->step());
        $this->assertEquals(1459, $collectible->auction_data->price()->raw());
        $this->assertEquals(5598, $collectible->auction_data->step()->raw());

        $rawAuction = json_decode($collectible->getRawOriginal('auction_data'), true);
        $this->assertEquals(3, count($rawAuction));
    }
}
