<?php

namespace App\Game\Controllers;

use App\Http\Controllers\Game\Admin\GamePlatformController;
use App\Http\Requests\Game\Admin\CreateGamePlatformRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Factories\Auth\UserFactory;
use Database\Factories\Game\GamePlatformFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GamePlatform;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

// TODO: add policy tests
class GamePlatformControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected GamePlatform $gamePlatform;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->gamePlatform = GamePlatformFactory::new()->create();

        $this->request = CreateGamePlatformRequest::factory()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([GamePlatformController::class, $action], $params), $request)
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
        $this->checkNotAuthRedirect('edit', 'get', [$this->gamePlatform->slug]);
        $this->checkNotAuthRedirect('store', 'post');
        $this->checkNotAuthRedirect('update', 'put', [$this->gamePlatform->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->gamePlatform->slug]);
    }

    /**
     * @test
     * @return void
     */
    public function it_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GamePlatformController::class, 'index']))
            ->assertOk()
            ->assertSee(__('game.platform.list'))
            ->assertViewIs('admin.game.platform.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GamePlatformController::class, 'create']))
            ->assertOk()
            ->assertSee(__('game.platform.add'))
            ->assertViewIs('admin.game.platform.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GamePlatformController::class, 'edit'], [$this->gamePlatform->slug]))
            ->assertOk()
            ->assertSee($this->gamePlatform->name)
            ->assertViewIs('admin.game.platform.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {
        $this->actingAs($this->user)
            ->post(action([GamePlatformController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.game-platforms.index')
            ->assertSessionHas('helper_flash_message', __('game.platform.created'));

        $this->assertDatabaseHas('game_platforms', [
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
            ->post(action([GamePlatformController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.game-platforms.index')
            ->assertSessionHas('helper_flash_message', __('game.platform.created'));

        $this->assertDatabaseHas('game_platforms', [
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
        $this->app['session']->setPreviousUrl(route('admin.game-platforms.create'));

        $this->request['name'] = '';

        $this->actingAs($this->user)
            ->post(action([GamePlatformController::class, 'store']), $this->request)
            ->assertInvalid(['name'])
            ->assertRedirectToRoute('admin.game-platforms.create');

        $this->assertDatabaseMissing('game_platforms', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_featured_image_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.game-platforms.create'));

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.php');

        $this->actingAs($this->user)
            ->post(action([GamePlatformController::class, 'store']), $this->request)
            ->assertInvalid(['featured_image'])
            ->assertRedirectToRoute('admin.game-platforms.create');
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
                    [GamePlatformController::class, 'update'],
                    [$this->gamePlatform->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.game-platforms.index')
            ->assertSessionHas('helper_flash_message', __('game.platform.updated'));

        $this->assertDatabaseHas('game_platforms', [
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
            ->delete(action([GamePlatformController::class, 'destroy'], [$this->gamePlatform->slug]))
            ->assertRedirectToRoute('admin.game-platforms.index')
            ->assertSessionHas('helper_flash_message', __('game.platform.deleted'));

        $this->assertDatabaseMissing('game_platforms', [
            'name' => $this->gamePlatform->name,
            'deleted_at' => null
        ]);
    }
}
