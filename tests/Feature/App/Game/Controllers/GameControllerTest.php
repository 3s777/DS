<?php

namespace App\Game\Controllers;

use App\Http\Controllers\Game\Admin\GameController;
use App\Http\Requests\Game\Admin\CreateGameRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Factories\Auth\UserFactory;
use Database\Factories\Game\GameFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
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
            ->assertRedirectToRoute('admin.login');
    }

    public function test_pages_success(): void
    {
        $this->checkNotAuthRedirect('index');
        $this->checkNotAuthRedirect('create');
        $this->checkNotAuthRedirect('edit', 'get', [$this->game->slug]);
        $this->checkNotAuthRedirect('store', 'post');
        $this->checkNotAuthRedirect('update', 'put', [$this->game->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->game->slug]);
    }

    public function test_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameController::class, 'index']))
            ->assertOk()
            ->assertSee(__('game.list'))
            ->assertViewIs('admin.game.game.index');
    }

    public function test_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameController::class, 'create']))
            ->assertOk()
            ->assertSee(__('game.add'))
            ->assertViewIs('admin.game.game.create');
    }

    public function test_edtest_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameController::class, 'edit'], [$this->game->slug]))
            ->assertOk()
            ->assertSee($this->game->name)
            ->assertViewIs('admin.game.game.edit');
    }

    public function test_store_success(): void
    {
        $this->actingAs($this->user)
            ->post(action([GameController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.games.index')
            ->assertSessionHas('helper_flash_message', __('game.created'));

        $this->assertDatabaseHas('games', [
            'name' => $this->request['name']
        ]);
    }

    public function test_store_with_image_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $this->actingAs($this->user)
            ->post(action([GameController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.games.index')
            ->assertSessionHas('helper_flash_message', __('game.created'));

        $this->assertDatabaseHas('games', [
            'name' => $this->request['name']
        ]);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    public function test_validation_name_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.games.create'));

        $this->request['name'] = '';
        $this->request['released_at'] = 'fake';
        $this->request['alternative_names'] = ['fake', 'fake 2'];
        $this->request['user_id'] = 1500000;
        $this->request['genres'] = 1500000;
        $this->request['platforms'] = 1500000;
        $this->request['developers'] = 1500000;
        $this->request['publishers'] = 1500000;

        $this->actingAs($this->user)
            ->post(action([GameController::class, 'store']), $this->request)
            ->assertInvalid([
                'name',
                'released_at',
                'alternative_names',
                'user_id',
                'genres',
                'platforms',
                'developers',
                'publishers'
            ])
            ->assertRedirectToRoute('admin.games.create');

        $this->assertDatabaseMissing('games', [
            'name' => $this->request['name']
        ]);
    }

    public function test_validation_featured_image_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.games.create'));

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.php');

        $this->actingAs($this->user)
            ->post(action([GameController::class, 'store']), $this->request)
            ->assertInvalid(['featured_image'])
            ->assertRedirectToRoute('admin.games.create');
    }

    public function test_update_success(): void
    {
        $this->request['name'] = 'newName';

        $this->actingAs($this->user)
            ->put(
                action(
                    [GameController::class, 'update'],
                    [$this->game->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.games.index')
            ->assertSessionHas('helper_flash_message', __('game.updated'));

        $this->assertDatabaseHas('games', [
            'name' => $this->request['name']
        ]);
    }

    public function test_update_validation_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.games.edit', $this->game->slug));

        $this->request['name'] = '';
        $this->request['released_at'] = 'fake';
        $this->request['alternative_names'] = ['fake', 'fake 2'];
        $this->request['user_id'] = 1500000;
        $this->request['genres'] = 1500000;
        $this->request['platforms'] = 1500000;
        $this->request['developers'] = 1500000;
        $this->request['publishers'] = 1500000;

        $this->actingAs($this->user)
            ->put(
                action(
                    [GameController::class, 'update'],
                    [$this->game->slug]
                ),
                $this->request
            )
            ->assertInvalid(
                [
                    'name',
                    'released_at',
                    'alternative_names',
                    'user_id',
                    'genres',
                    'platforms',
                    'developers',
                    'publishers'
                ]
            )
            ->assertRedirectToRoute('admin.games.edit', $this->game->slug);
    }

    public function test_delete_success(): void
    {
        $this->actingAs($this->user)
            ->delete(action([GameController::class, 'destroy'], [$this->game->slug]))
            ->assertRedirectToRoute('admin.games.index')
            ->assertSessionHas('helper_flash_message', __('game.deleted'));

        $this->assertDatabaseMissing('games', [
            'name' => $this->game->name,
            'deleted_at' => null
        ]);
    }
}
