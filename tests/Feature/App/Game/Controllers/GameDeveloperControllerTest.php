<?php

namespace App\Game\Controllers;

use App\Http\Controllers\Game\GameDeveloperController;
use App\Http\Requests\Game\CreateGameDeveloperRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Factories\Game\GameDeveloperFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GameDeveloperControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected GameDeveloper $gameDeveloper;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();

        $this->gameDeveloper = GameDeveloperFactory::new()->create();

        $this->request = CreateGameDeveloperRequest::factory()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([GameDeveloperController::class, $action], $params), $request)
            ->assertRedirectToRoute('login');
    }

    /**
     * @test
     * @return void
     */
    public function it_pages_only_auth_success(): void
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
    public function it_index_only_auth_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameDeveloperController::class, 'index']))
            ->assertOk()
            ->assertSee(__('game.developer.list'))
            ->assertViewIs('admin.game.developer.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_create_only_auth_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameDeveloperController::class, 'create']))
            ->assertOk()
            ->assertSee(__('game.developer.add'))
            ->assertViewIs('admin.game.developer.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_only_auth_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameDeveloperController::class, 'edit'], [$this->gameDeveloper->slug]))
            ->assertOk()
            ->assertSee(__($this->gameDeveloper->name))
            ->assertViewIs('admin.game.developer.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_only_auth_success(): void
    {

        $this->actingAs($this->user)
            ->post(action([GameDeveloperController::class, 'store']), $this->request)
            ->assertRedirectToRoute('game-developers.index')
            ->assertSessionHas('helper_flash_message', __('game.developer.created'));

        $this->assertDatabaseHas('game_developers', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_store_with_image_only_auth_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->request['thumbnail'] = UploadedFile::fake()->image('photo1.jpg');

        $this->actingAs($this->user)
            ->post(action([GameDeveloperController::class, 'store']), $this->request)
            ->assertRedirectToRoute('game-developers.index')
            ->assertSessionHas('helper_flash_message', __('game.developer.created'));

        $this->assertDatabaseHas('game_developers', [
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
        $this->app['session']->setPreviousUrl(route('game-developers.create'));

        $this->request['name'] = '';

        $this->actingAs($this->user)
            ->post(action([GameDeveloperController::class, 'store']), $this->request)
            ->assertInvalid(['name'])
            ->assertRedirectToRoute('game-developers.create');

        $this->assertDatabaseMissing('game_developers', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_thumbnail_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('game-developers.create'));

        $this->request['thumbnail'] = UploadedFile::fake()->image('photo1.php');

        $this->actingAs($this->user)
            ->post(action([GameDeveloperController::class, 'store']), $this->request)
            ->assertInvalid(['thumbnail'])
            ->assertRedirectToRoute('game-developers.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_update_only_auth_success(): void
    {
        $this->request['name'] = 'newName';

        $this->actingAs($this->user)
            ->put(
                action(
                    [GameDeveloperController::class, 'update'],
                    [$this->gameDeveloper->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('game-developers.index')
            ->assertSessionHas('helper_flash_message', __('game.developer.updated'));

        $this->assertDatabaseHas('game_developers', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_only_auth_success(): void
    {
        $this->actingAs($this->user)
            ->delete(action([GameDeveloperController::class, 'destroy'], [$this->gameDeveloper->slug]))
            ->assertRedirectToRoute('game-developers.index')
            ->assertSessionHas('helper_flash_message', __('game.developer.deleted'));

        $this->assertDatabaseMissing('game_developers', [
            'name' => $this->gameDeveloper->name,
            'deleted_at' => null
        ]);
    }
}
