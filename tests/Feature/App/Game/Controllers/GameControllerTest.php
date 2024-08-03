<?php

namespace App\Game\Controllers;

use App\Http\Controllers\Game\GameController;
use App\Http\Requests\Game\CreateGameRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Factories\Game\GameFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


class GameControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Game $game;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->game = GameFactory::new()->create();

        $this->request = CreateGameRequest::factory()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([GameController::class, $action], $params), $request)
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
        $this->checkNotAuthRedirect('edit', 'get', [$this->game->slug]);
        $this->checkNotAuthRedirect('store', 'post', [$this->game->slug], $this->request);
        $this->checkNotAuthRedirect('update', 'put', [$this->game->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->game->slug]);
    }

    /**
     * @test
     * @return void
     */
    public function it_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameController::class, 'index']))
            ->assertOk()
            ->assertSee(__('game.list'))
            ->assertViewIs('admin.game.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameController::class, 'create']))
            ->assertOk()
            ->assertSee(__('game.add'))
            ->assertViewIs('admin.game.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameController::class, 'edit'], [$this->game->slug]))
            ->assertOk()
            ->assertSee($this->game->name)
            ->assertViewIs('admin.game.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {
        $this->actingAs($this->user)
            ->post(action([GameController::class, 'store']), $this->request)
            ->assertRedirectToRoute('games.index')
            ->assertSessionHas('helper_flash_message', __('game.created'));

        $this->assertDatabaseHas('games', [
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

        $this->request['thumbnail'] = UploadedFile::fake()->image('photo1.jpg');

        $this->actingAs($this->user)
            ->post(action([GameController::class, 'store']), $this->request)
            ->assertRedirectToRoute('games.index')
            ->assertSessionHas('helper_flash_message', __('game.created'));

        $this->assertDatabaseHas('games', [
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
        $this->app['session']->setPreviousUrl(route('games.create'));

        $this->request['name'] = '';

        $this->actingAs($this->user)
            ->post(action([GameController::class, 'store']), $this->request)
            ->assertInvalid(['name'])
            ->assertRedirectToRoute('games.create');

        $this->assertDatabaseMissing('games', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_thumbnail_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('games.create'));

        $this->request['thumbnail'] = UploadedFile::fake()->image('photo1.php');

        $this->actingAs($this->user)
            ->post(action([GameController::class, 'store']), $this->request)
            ->assertInvalid(['thumbnail'])
            ->assertRedirectToRoute('games.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_update_success(): void
    {
        $this->request['name'] = 'newName';

        //TODO: check updating user_id
        $this->actingAs($this->user)
            ->put(
                action(
                    [GameController::class, 'update'],
                    [$this->game->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('games.index')
            ->assertSessionHas('helper_flash_message', __('game.updated'));

        $this->assertDatabaseHas('games', [
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
            ->delete(action([GameController::class, 'destroy'], [$this->game->slug]))
            ->assertRedirectToRoute('games.index')
            ->assertSessionHas('helper_flash_message', __('game.deleted'));

        $this->assertDatabaseMissing('games', [
            'name' => $this->game->name,
            'deleted_at' => null
        ]);
    }
}
