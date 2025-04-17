<?php

namespace App\Game\Controllers;

use App\Http\Controllers\Game\Admin\GameGenreController;
use App\Http\Requests\Game\Admin\CreateGameGenreRequest;
use Database\Factories\Auth\UserFactory;
use Database\Factories\Game\GameGenreFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameGenre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// TODO: add policy tests
class GameGenreControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected GameGenre $gameGenre;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->gameDeveloper = GameGenreFactory::new()->create();

        $this->request = CreateGameGenreRequest::factory()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([GameGenreController::class, $action], $params), $request)
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
            ->get(action([GameGenreController::class, 'index']))
            ->assertOk()
            ->assertSee(__('game.genre.list'))
            ->assertViewIs('admin.game.genre.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameGenreController::class, 'create']))
            ->assertOk()
            ->assertSee(__('game.genre.add'))
            ->assertViewIs('admin.game.genre.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameGenreController::class, 'edit'], [$this->gameDeveloper->slug]))
            ->assertOk()
            ->assertSee($this->gameDeveloper->name)
            ->assertViewIs('admin.game.genre.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {

        $this->actingAs($this->user)
            ->post(action([GameGenreController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.game-genres.index')
            ->assertSessionHas('helper_flash_message', __('game.genre.created'));

        $this->assertDatabaseHas('game_genres', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_name_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.game-genres.create'));

        $this->request['name'] = '';

        $this->actingAs($this->user)
            ->post(action([GameGenreController::class, 'store']), $this->request)
            ->assertInvalid(['name'])
            ->assertRedirectToRoute('admin.game-genres.create');

        $this->assertDatabaseMissing('game_genres', [
            'name' => $this->request['name']
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
                    [GameGenreController::class, 'update'],
                    [$this->gameDeveloper->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.game-genres.index')
            ->assertSessionHas('helper_flash_message', __('game.genre.updated'));

        $this->assertDatabaseHas('game_genres', [
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
            ->delete(action([GameGenreController::class, 'destroy'], [$this->gameDeveloper->slug]))
            ->assertRedirectToRoute('admin.game-genres.index')
            ->assertSessionHas('helper_flash_message', __('game.genre.deleted'));

        $this->assertDatabaseMissing('game_genres', [
            'name' => $this->gameDeveloper->name,
            'deleted_at' => null
        ]);
    }
}
