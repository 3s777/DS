<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Requests\Game\CreateGameDeveloperRequest;
use Database\Factories\GameDeveloperFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function checkNotAuthRedirect(string $method, array $params = []): void
    {
        $this->get(action([GameDeveloperController::class, $method], $params))
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @return void
     */
    public function it_index_only_auth_success(): void
    {
        $this->checkNotAuthRedirect('index');

        $this->actingAs($this->user);

        $this->get(action([GameDeveloperController::class, 'index']))
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
        $this->checkNotAuthRedirect('create');

        $this->actingAs($this->user);

        $this->get(action([GameDeveloperController::class, 'create']))
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
        $this->checkNotAuthRedirect('edit',  [$this->gameDeveloper->slug]);

        $this->actingAs($this->user);

        $this->get(action([GameDeveloperController::class, 'edit'],
            [$this->gameDeveloper->slug]))
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
        $this->post(
            action([GameDeveloperController::class, 'store']),
            $this->request
        )->assertRedirect(route('login'));

        $this->actingAs($this->user);

        $this->post(
            action([GameDeveloperController::class, 'store']),
            $this->request
        )->assertRedirect(route('game-developers.index'));

        $this->assertDatabaseHas('game_developers', [
            'name' => $this->request['name']
        ]);
    }



    /**
     * @test
     * @return void
     */
    public function it_page_success(): void
    {
        $this->get(action([LoginController::class, 'page']))
            ->assertOk()
            ->assertSee('Войти')
            ->assertViewIs('content.auth.login');

    }

    /**
     * @test
     * @return void
     */
    public function it_only_guest_success(): void
    {
        $this->post(action([LoginController::class, 'handle']), $this->request);

        $this->get(action([LoginController::class, 'page']))
            ->assertRedirect('/');
    }

    /**
     * @test
     * @return void
     */
    public function it_handle_success(): void
    {
        $response = $this->post(action([LoginController::class, 'handle']), $this->request);

        $response->assertValid()
            ->assertRedirect(route('search'));

        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * @test
     * @return void
     */
    public function it_handle_fail(): void
    {
        $request = [
            'email' => 'test@notexist.com',
            'password' => str()->random(10),
        ];

        $this->post(action([LoginController::class, 'handle']), $request)
            ->assertSessionHas('helper_flash_message', __('auth.error.credentials'));

        $this->assertGuest();
    }



    /**
     * @test
     * @return void
     */
    public function it_logout_success(): void
    {
        $user = UserFactory::new()->create();

        $this->actingAs($user)->delete(action([LoginController::class, 'logout']));

        $this->assertGuest();
    }

    /**
     * @test
     * @return void
     */
    public function it_logout_guest_middleware_fail(): void
    {
        $this->delete(action([LoginController::class, 'logout']))
            ->assertRedirect(route('home'));
    }

}
