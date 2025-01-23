<?php

namespace App\Shelf\Casts;

use App\Http\Controllers\Shelf\CollectibleGameController;
use App\Http\Requests\Shelf\CreateCollectibleGameRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Factories\Shelf\CollectibleFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Support\ValueObjects\PriceValueObject;
use Support\ValueObjects\SaleValueObject;
use Tests\TestCase;

class SaleCastTest extends TestCase
{
//    use RefreshDatabase;
//
//    protected User $user;
//    protected Collectible $collectible;
//    protected Category $category;
//
//    public function setUp(): void
//    {
//        parent::setUp();
//
//        $this->user = UserFactory::new()->create();
//        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
//        $this->user->assignRole('super_admin');
//
//        $this->category = Category::factory()->create(['model' => Relation::getMorphAlias(GameMedia::class)]);
//    }
//
//    /**
//     * @test
//     * @return void
//     */
//    public function it_sale_success():void
//    {
//        $collectible = CollectibleFactory::new()->for(GameMedia::factory(), 'collectable')
//            ->for($this->category)
//            ->create(
//                [
//                    'sale' => [
//                        'price' => 12.99
//                    ]
//                ]
//            );
//
//        $this->assertInstanceOf(SaleValueObject::class, $collectible->sale);
//        $this->assertInstanceOf(PriceValueObject::class, $collectible->sale->price());
//        $this->assertEmpty($collectible->sale->priceOld());
//        $this->assertEquals(1299, $collectible->sale->price()->raw());
//
//        $collectible->sale = [
//            'price' => 14.5989,
//            'price_old' => 55.9888,
//            'test' => 'test'
//        ];
//
//        $collectible->save();
//
//        $this->assertInstanceOf(SaleValueObject::class, $collectible->sale);
//        $this->assertInstanceOf(PriceValueObject::class, $collectible->sale->price());
//        $this->assertInstanceOf(PriceValueObject::class, $collectible->sale->priceOld());
//        $this->assertEquals(1459, $collectible->sale->price()->raw());
//        $this->assertEquals(5598, $collectible->sale->priceOld()->raw());
//
//        $rawSale = json_decode($collectible->getRawOriginal('sale'), true);
//        $this->assertEquals(2, count($rawSale));
//    }
}
