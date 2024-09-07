<?php

namespace App\Game\Controllers;

use App\Http\Controllers\Game\GamePublisherController;
use App\Http\Requests\Game\CreateGamePublisherRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Factories\Game\GamePublisherFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GamePublisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GamePublisherControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected GamePublisher $gamePublisher;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->gamePublisher = GamePublisherFactory::new()->create();

        $this->request = CreateGamePublisherRequest::factory()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([GamePublisherController::class, $action], $params), $request)
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
        $this->checkNotAuthRedirect('edit', 'get', [$this->gamePublisher->slug]);
        $this->checkNotAuthRedirect('store', 'post', [$this->gamePublisher->slug], $this->request);
        $this->checkNotAuthRedirect('update', 'put', [$this->gamePublisher->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->gamePublisher->slug]);
    }

    /**
     * @test
     * @return void
     */
    public function it_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GamePublisherController::class, 'index']))
            ->assertOk()
            ->assertSee(__('game_publisher.list'))
            ->assertViewIs('admin.game.publisher.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GamePublisherController::class, 'create']))
            ->assertOk()
            ->assertSee(__('game_publisher.add'))
            ->assertViewIs('admin.game.publisher.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GamePublisherController::class, 'edit'], [$this->gamePublisher->slug]))
            ->assertOk()
            ->assertSee($this->gamePublisher->name)
            ->assertViewIs('admin.game.publisher.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {
        $this->actingAs($this->user)
            ->post(action([GamePublisherController::class, 'store']), $this->request)
            ->assertRedirectToRoute('game-publishers.index')
            ->assertSessionHas('helper_flash_message', __('game_publisher.created'));

        $this->assertDatabaseHas('game_publishers', [
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
            ->post(action([GamePublisherController::class, 'store']), $this->request)
            ->assertRedirectToRoute('game-publishers.index')
            ->assertSessionHas('helper_flash_message', __('game_publisher.created'));

        $this->assertDatabaseHas('game_publishers', [
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
        $this->app['session']->setPreviousUrl(route('game-publishers.create'));

        $this->request['name'] = '';

        $this->actingAs($this->user)
            ->post(action([GamePublisherController::class, 'store']), $this->request)
            ->assertInvalid(['name'])
            ->assertRedirectToRoute('game-publishers.create');

        $this->assertDatabaseMissing('game_publishers', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_thumbnail_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('game-publishers.create'));

        $this->request['thumbnail'] = UploadedFile::fake()->image('photo1.php');

        $this->actingAs($this->user)
            ->post(action([GamePublisherController::class, 'store']), $this->request)
            ->assertInvalid(['thumbnail'])
            ->assertRedirectToRoute('game-publishers.create');
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
                    [GamePublisherController::class, 'update'],
                    [$this->gamePublisher->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('game-publishers.index')
            ->assertSessionHas('helper_flash_message', __('game_publisher.updated'));

        $this->assertDatabaseHas('game_publishers', [
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
            ->delete(action([GamePublisherController::class, 'destroy'], [$this->gamePublisher->slug]))
            ->assertRedirectToRoute('game-publishers.index')
            ->assertSessionHas('helper_flash_message', __('game_publisher.deleted'));

        $this->assertDatabaseMissing('game_publishers', [
            'name' => $this->gamePublisher->name,
            'deleted_at' => null
        ]);
    }
}
