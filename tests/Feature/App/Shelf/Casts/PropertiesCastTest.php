<?php

namespace App\Shelf\Casts;

use Database\Factories\Shelf\CollectibleFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertiesCastTest extends TestCase
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
                    'properties' => [
                        'is_done' => 'test'
                    ]
                ]
            );
        $this->assertTrue($collectible->properties['is_done']);

        $collectible->properties = [
            'is_done' => false,
            'is_digital' => true,
            'test' => 'wrong parameter'
        ];

        $collectible->save();

        $this->assertTrue($collectible->properties['is_digital']);

        $rawProperties = json_decode($collectible->getRawOriginal('properties'), true);
        $this->assertSame(1, count($rawProperties));
    }
}
