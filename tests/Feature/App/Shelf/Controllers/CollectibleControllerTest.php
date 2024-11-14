<?php

namespace App\Shelf\Controllers;

use App\Http\Controllers\Shelf\CollectibleController;
use App\Http\Requests\Shelf\CreateCollectibleGameRequest;
use Database\Factories\Shelf\CollectibleFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Models\Collectible;
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

        $this->collectible = CollectibleFactory::new()->for(GameMedia::factory(), 'collectable')->create();

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
            ->assertRedirectToRoute('login');
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
            ->assertRedirectToRoute('collectibles.index')
            ->assertSessionHas('helper_flash_message', __('collectible.deleted'));

        $this->assertDatabaseMissing('collectibles', [
            'name' => $this->collectible->name,
            'deleted_at' => null
        ]);
    }
}
