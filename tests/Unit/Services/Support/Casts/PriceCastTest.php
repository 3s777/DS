<?php

namespace Services\Support\Casts;

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
                    'purchase_price' => 12.99
                ]
            );

        $this->assertInstanceOf(PriceValueObject::class, $collectible->purchase_price);
        $this->assertEquals(1299, $collectible->purchase_price->raw());

        $collectible->purchase_price = 14.5989;

        $collectible->save();

        $this->assertInstanceOf(PriceValueObject::class, $collectible->purchase_price);
        $this->assertEquals(1459, $collectible->purchase_price->raw());
    }
}
