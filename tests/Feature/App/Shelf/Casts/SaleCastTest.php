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
use Tests\TestCase;

class SaleCastTest extends TestCase
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

        $this->collectible = CollectibleFactory::new()->for(GameMedia::factory(), 'collectable')
            ->for(Category::factory()->create([
                'model' => Relation::getMorphAlias(GameMedia::class)
            ]))
            ->create();

        $this->request = CreateCollectibleGameRequest::factory()->hasKitConditions()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_sale_success():void
    {
        $collectible = CollectibleFactory::new()->for(GameMedia::factory(), 'collectable')
//            ->for(Category::factory()->create([
//                'model' => Relation::getMorphAlias(GameMedia::class)
//            ]))
            ->create();
    }
}
