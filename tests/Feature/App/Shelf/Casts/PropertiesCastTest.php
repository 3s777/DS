<?php

namespace App\Shelf\Casts;

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
            'properties' => [
                'is_done' => 'test'
            ]
        ];

        $collectible = CollectibleFactory::new()
            ->for($this->category)
            ->create($attributes);
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
