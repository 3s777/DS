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
use Domain\Trade\ValueObjects\SaleValueObject;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Support\ValueObjects\PriceValueObject;
use Tests\TestCase;

class SaleCastTest extends TestCase
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
    public function it_sale_success(): void
    {
        $country = Country::factory()->create();
        $collectible = CollectibleFactory::new()->for(GameMedia::factory(), 'collectable')
            ->for($this->category)
            ->create(
                [
                    'sale_data' => [
                        'price' => 12.99,
                        'quantity' => 1,
                        'country_id' => $country->id,
                        'shipping' => ShippingEnum::None->value,
                    ]
                ]
            );

        $this->assertInstanceOf(SaleValueObject::class, $collectible->sale_data);
        $this->assertInstanceOf(PriceValueObject::class, $collectible->sale_data->price());
        $this->assertEmpty($collectible->sale_data->priceOld());
        $this->assertSame(1299, $collectible->sale_data->price()->raw());

        $collectible->sale_data = [
            'price' => 14.5989,
            'quantity' => 1,
            'country_id' => $country->id,
            'shipping' => ShippingEnum::None->value,
            'price_old' => 55.9888,
            'test' => 'test'
        ];

        $collectible->save();

        $this->assertInstanceOf(SaleValueObject::class, $collectible->sale_data);
        $this->assertInstanceOf(PriceValueObject::class, $collectible->sale_data->price());
        $this->assertInstanceOf(PriceValueObject::class, $collectible->sale_data->priceOld());
        $this->assertSame(1459, $collectible->sale_data->price()->raw());
        $this->assertSame(5598, $collectible->sale_data->priceOld()->raw());

        $rawSale = json_decode($collectible->getRawOriginal('sale_data'), true);
        $this->assertSame(8, count($rawSale));
    }
}
