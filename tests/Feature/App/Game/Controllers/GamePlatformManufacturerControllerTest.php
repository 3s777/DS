<?php

namespace App\Game\Controllers;

use App\Http\Controllers\Game\Admin\GamePlatformManufacturerController;
use App\Http\Requests\Game\Admin\CreateGamePlatformManufacturerRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Factories\Game\GamePlatformManufacturerFactory;
use Database\Factories\UserFactory;
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

    /**
     * @test
     * @return void
     */
    public function it_pages_success(): void
    {
        $this->checkNotAuthRedirect('index');
        $this->checkNotAuthRedirect('create');
        $this->checkNotAuthRedirect('edit', 'get', [$this->gameDeveloper->slug]);
        $this->checkNotAuthRedirect('store', 'post', [$this->gameDeveloper->slug], $this->request);
        $this->checkNotAuthRedirect('update', 'put', [$this->gameDeveloper->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->gameDeveloper->slug]);
    }

    /**
     * @test
     * @return void
     */
    public function it_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GamePlatformManufacturerController::class, 'index']))
            ->assertOk()
            ->assertSee(__('game_platform_manufacturer.list'))
            ->assertViewIs('admin.game.platform-manufacturer.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GamePlatformManufacturerController::class, 'create']))
            ->assertOk()
            ->assertSee(__('game_platform_manufacturer.add'))
            ->assertViewIs('admin.game.platform-manufacturer.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GamePlatformManufacturerController::class, 'edit'], [$this->gameDeveloper->slug]))
            ->assertOk()
            ->assertSee($this->gameDeveloper->name)
            ->assertViewIs('admin.game.platform-manufacturer.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {

        $this->actingAs($this->user)
            ->post(action([GamePlatformManufacturerController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.game-platform-manufacturers.index')
            ->assertSessionHas('helper_flash_message', __('game_platform_manufacturer.created'));

        $this->assertDatabaseHas('game_platform_manufacturers', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_store_with_image_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $this->actingAs($this->user)
            ->post(action([GamePlatformManufacturerController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.game-platform-manufacturers.index')
            ->assertSessionHas('helper_flash_message', __('game_platform_manufacturer.created'));

        $this->assertDatabaseHas('game_platform_manufacturers', [
            'name' => $this->request['name']
        ]);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_name_fail(): void
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

    /**
     * @test
     * @return void
     */
    public function it_validation_featured_image_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.game-platform-manufacturers.create'));

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.php');

        $this->actingAs($this->user)
            ->post(action([GamePlatformManufacturerController::class, 'store']), $this->request)
            ->assertInvalid(['featured_image'])
            ->assertRedirectToRoute('admin.game-platform-manufacturers.create');
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
                    [GamePlatformManufacturerController::class, 'update'],
                    [$this->gameDeveloper->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.game-platform-manufacturers.index')
            ->assertSessionHas('helper_flash_message', __('game_platform_manufacturer.updated'));

        $this->assertDatabaseHas('game_platform_manufacturers', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_success(): void
    {
        $this->actingAs($this->user)
            ->delete(action([GamePlatformManufacturerController::class, 'destroy'], [$this->gameDeveloper->slug]))
            ->assertRedirectToRoute('admin.game-platform-manufacturers.index')
            ->assertSessionHas('helper_flash_message', __('game_platform_manufacturer.deleted'));

        $this->assertDatabaseMissing('game_platform_manufacturers', [
            'name' => $this->gameDeveloper->name,
            'deleted_at' => null
        ]);
    }
}
