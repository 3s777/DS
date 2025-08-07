<?php

namespace App\Shelf\Controllers;

use App\Http\Controllers\Shelf\Admin\KitItemController;
use App\Http\Requests\Shelf\Admin\CreateKitItemRequest;
use Database\Factories\Auth\UserFactory;
use Database\Factories\Shelf\KitItemFactory;
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
            ->assertRedirectToRoute('admin.login');
    }

    public function test_pages_success(): void
    {
        $this->checkNotAuthRedirect('index');
        $this->checkNotAuthRedirect('create');
        $this->checkNotAuthRedirect('edit', 'get', [$this->kitItem->slug]);
        $this->checkNotAuthRedirect('store', 'post');
        $this->checkNotAuthRedirect('update', 'put', [$this->kitItem->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->kitItem->slug]);
    }

    public function test_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([KitItemController::class, 'index']))
            ->assertOk()
            ->assertSee(__('collectible.kit.list'))
            ->assertViewIs('admin.shelf.kit-item.index');
    }

    public function test_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([KitItemController::class, 'create']))
            ->assertOk()
            ->assertSee(__('collectible.kit.add'))
            ->assertViewIs('admin.shelf.kit-item.create');
    }

    public function test_edtest_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([KitItemController::class, 'edit'], [$this->kitItem->slug]))
            ->assertOk()
            ->assertSee($this->kitItem->name)
            ->assertViewIs('admin.shelf.kit-item.edit');
    }

    public function test_store_success(): void
    {
        $this->actingAs($this->user)
            ->post(action([KitItemController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.kit-items.index')
            ->assertSessionHas('helper_flash_message', __('collectible.kit.created'));

        $this->assertDatabaseHas('kit_items', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    public function test_validation_name_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.kit-items.create'));

        $this->request['name'] = '';

        $this->actingAs($this->user)
            ->post(action([KitItemController::class, 'store']), $this->request)
            ->assertInvalid(['name'])
            ->assertRedirectToRoute('admin.kit-items.create');

        $this->assertDatabaseMissing('kit_items', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    public function test_update_success(): void
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
            ->assertRedirectToRoute('admin.kit-items.index')
            ->assertSessionHas('helper_flash_message', __('collectible.kit.updated'));

        $this->assertDatabaseHas('kit_items', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    public function test_delete_success(): void
    {
        $this->actingAs($this->user)
            ->delete(action([KitItemController::class, 'destroy'], [$this->kitItem->slug]))
            ->assertRedirectToRoute('admin.kit-items.index')
            ->assertSessionHas('helper_flash_message', __('collectible.kit.deleted'));

        $this->assertDatabaseMissing('kit_items', [
            'slug' => Str::slug($this->request['name']),
            'deleted_at' => null
        ]);
    }
}
