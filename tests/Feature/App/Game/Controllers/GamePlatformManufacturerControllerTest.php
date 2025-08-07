<?php

namespace App\Game\Controllers;

use App\Http\Controllers\Game\Admin\GamePlatformManufacturerController;
use App\Http\Requests\Game\Admin\CreateGamePlatformManufacturerRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Factories\Auth\UserFactory;
use Database\Factories\Game\GamePlatformManufacturerFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GamePlatformManufacturer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

// TODO: add policy tests
class GamePlatformManufacturerControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected GamePlatformManufacturer $gamePlatformManufacturer;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->gameDeveloper = GamePlatformManufacturerFactory::new()->create();

        $this->request = CreateGamePlatformManufacturerRequest::factory()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([GamePlatformManufacturerController::class, $action], $params), $request)
            ->assertRedirectToRoute('admin.login');
    }

    public function test_pages_success(): void
    {
        $this->checkNotAuthRedirect('index');
        $this->checkNotAuthRedirect('create');
        $this->checkNotAuthRedirect('edit', 'get', [$this->gameDeveloper->slug]);
        $this->checkNotAuthRedirect('store', 'post');
        $this->checkNotAuthRedirect('update', 'put', [$this->gameDeveloper->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->gameDeveloper->slug]);
    }

    public function test_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GamePlatformManufacturerController::class, 'index']))
            ->assertOk()
            ->assertSee(__('game.platform_manufacturer.list'))
            ->assertViewIs('admin.game.platform-manufacturer.index');
    }

    public function test_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GamePlatformManufacturerController::class, 'create']))
            ->assertOk()
            ->assertSee(__('game.platform_manufacturer.add'))
            ->assertViewIs('admin.game.platform-manufacturer.create');
    }

    public function test_edtest_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GamePlatformManufacturerController::class, 'edit'], [$this->gameDeveloper->slug]))
            ->assertOk()
            ->assertSee($this->gameDeveloper->name)
            ->assertViewIs('admin.game.platform-manufacturer.edit');
    }

    public function test_store_success(): void
    {

        $this->actingAs($this->user)
            ->post(action([GamePlatformManufacturerController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.game-platform-manufacturers.index')
            ->assertSessionHas('helper_flash_message', __('game.platform_manufacturer.created'));

        $this->assertDatabaseHas('game_platform_manufacturers', [
            'name' => $this->request['name']
        ]);
    }

    public function test_store_with_image_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $this->actingAs($this->user)
            ->post(action([GamePlatformManufacturerController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.game-platform-manufacturers.index')
            ->assertSessionHas('helper_flash_message', __('game.platform_manufacturer.created'));

        $this->assertDatabaseHas('game_platform_manufacturers', [
            'name' => $this->request['name']
        ]);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    public function test_validation_name_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.game-platform-manufacturers.create'));

        $this->request['name'] = '';

        $this->actingAs($this->user)
            ->post(action([GamePlatformManufacturerController::class, 'store']), $this->request)
            ->assertInvalid(['name'])
            ->assertRedirectToRoute('admin.game-platform-manufacturers.create');

        $this->assertDatabaseMissing('game_platform_manufacturers', [
            'name' => $this->request['name']
        ]);
    }

    public function test_validation_featured_image_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.game-platform-manufacturers.create'));

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.php');

        $this->actingAs($this->user)
            ->post(action([GamePlatformManufacturerController::class, 'store']), $this->request)
            ->assertInvalid(['featured_image'])
            ->assertRedirectToRoute('admin.game-platform-manufacturers.create');
    }

    public function test_update_success(): void
    {
        $this->request['name'] = 'newName';

        $this->actingAs($this->user)
            ->put(
                action(
                    [GamePlatformManufacturerController::class, 'update'],
                    [$this->gameDeveloper->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.game-platform-manufacturers.index')
            ->assertSessionHas('helper_flash_message', __('game.platform_manufacturer.updated'));

        $this->assertDatabaseHas('game_platform_manufacturers', [
            'name' => $this->request['name']
        ]);
    }

    public function test_delete_success(): void
    {
        $this->actingAs($this->user)
            ->delete(action([GamePlatformManufacturerController::class, 'destroy'], [$this->gameDeveloper->slug]))
            ->assertRedirectToRoute('admin.game-platform-manufacturers.index')
            ->assertSessionHas('helper_flash_message', __('game.platform_manufacturer.deleted'));

        $this->assertDatabaseMissing('game_platform_manufacturers', [
            'name' => $this->gameDeveloper->name,
            'deleted_at' => null
        ]);
    }
}
