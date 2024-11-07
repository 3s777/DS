<?php

namespace App\Shelf\Controllers;

use App\Http\Controllers\Shelf\KitItemController;
use App\Http\Requests\Shelf\CreateKitItemRequest;
use Database\Factories\Shelf\KitItemFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Shelf\Models\KitItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;


class KitItemControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected KitItem $kitItem;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->kitItem = KitItemFactory::new()->create();

        $this->request = CreateKitItemRequest::factory()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([KitItemController::class, $action], $params), $request)
            ->assertRedirectToRoute('login');
    }

    /**
     * @test
     * @return void
     */
    public function it_pages_success(): void
    {
        $this->checkNotAuthRedirect('index');
        $this->checkNotAuthRedirect('create');
        $this->checkNotAuthRedirect('edit', 'get', [$this->kitItem->slug]);
        $this->checkNotAuthRedirect('store', 'post', [$this->kitItem->slug], $this->request);
        $this->checkNotAuthRedirect('update', 'put', [$this->kitItem->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->kitItem->slug]);
    }

    /**
     * @test
     * @return void
     */
    public function it_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([KitItemController::class, 'index']))
            ->assertOk()
            ->assertSee(__('collectible.kit.list'))
            ->assertViewIs('admin.shelf.kit-item.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([KitItemController::class, 'create']))
            ->assertOk()
            ->assertSee(__('collectible.kit.add'))
            ->assertViewIs('admin.shelf.kit-item.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([KitItemController::class, 'edit'], [$this->kitItem->slug]))
            ->assertOk()
            ->assertSee($this->kitItem->name)
            ->assertViewIs('admin.shelf.kit-item.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {
        $this->actingAs($this->user)
            ->post(action([KitItemController::class, 'store']), $this->request)
            ->assertRedirectToRoute('kit-items.index')
            ->assertSessionHas('helper_flash_message', __('collectible.kit.created'));

        $this->assertDatabaseHas('kit_items', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_name_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('kit-items.create'));

        $this->request['name'] = '';

        $this->actingAs($this->user)
            ->post(action([KitItemController::class, 'store']), $this->request)
            ->assertInvalid(['name'])
            ->assertRedirectToRoute('kit-items.create');

        $this->assertDatabaseMissing('kit_items', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_update_success(): void
    {
        $this->request['name'] = 'newName';

        $this->actingAs($this->user)
            ->put(
                action(
                    [KitItemController::class, 'update'],
                    [$this->kitItem->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('kit-items.index')
            ->assertSessionHas('helper_flash_message', __('collectible.kit.updated'));

        $this->assertDatabaseHas('kit_items', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_success(): void
    {
        $this->actingAs($this->user)
            ->delete(action([KitItemController::class, 'destroy'], [$this->kitItem->slug]))
            ->assertRedirectToRoute('kit-items.index')
            ->assertSessionHas('helper_flash_message', __('collectible.kit.deleted'));

        $this->assertDatabaseMissing('kit_items', [
            'slug' => Str::slug($this->request['name']),
            'deleted_at' => null
        ]);
    }
}
