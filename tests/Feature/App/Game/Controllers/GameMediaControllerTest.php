<?php

namespace App\Game\Controllers;

use App\Http\Controllers\Game\GameMediaController;
use App\Http\Requests\Game\CreateGameMediaRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Factories\Game\GameMediaFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GameMediaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected GameMedia $gameMedia;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->gameMedia = GameMediaFactory::new()->create();

        $this->request = CreateGameMediaRequest::factory()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([GameMediaController::class, $action], $params), $request)
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
        $this->checkNotAuthRedirect('edit', 'get', [$this->gameMedia->slug]);
        $this->checkNotAuthRedirect('store', 'post', [$this->gameMedia->slug], $this->request);
        $this->checkNotAuthRedirect('update', 'put', [$this->gameMedia->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->gameMedia->slug]);
    }

    /**
     * @test
     * @return void
     */
    public function it_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameMediaController::class, 'index']))
            ->assertOk()
            ->assertSee(__('game_media.list'))
            ->assertViewIs('admin.game.media.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameMediaController::class, 'create']))
            ->assertOk()
            ->assertSee(__('game_media.add'))
            ->assertViewIs('admin.game.media.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameMediaController::class, 'edit'], [$this->gameMedia->slug]))
            ->assertOk()
            ->assertSee($this->gameMedia->name)
            ->assertViewIs('admin.game.media.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {
        $this->actingAs($this->user)
            ->post(action([GameMediaController::class, 'store']), $this->request)
            ->assertRedirectToRoute('game-medias.index')
            ->assertSessionHas('helper_flash_message', __('game_media.created'));

        $this->assertDatabaseHas('game_medias', [
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
            ->post(action([GameMediaController::class, 'store']), $this->request)
            ->assertRedirectToRoute('game-medias.index')
            ->assertSessionHas('helper_flash_message', __('game_media.created'));

        $this->assertDatabaseHas('game_medias', [
            'name' => $this->request['name']
        ]);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('game-medias.create'));

        $this->request['name'] = '';
        $this->request['article_number'] = ['fake', 'fake 2'];
        $this->request['alternative_names'] = ['fake', 'fake 2'];
        $this->request['barcodes'] = ['fake', 'fake 2'];
        $this->request['user_id'] = 1500000;
        $this->request['genres'] = 1500000;

        $this->actingAs($this->user)
            ->post(action([GameMediaController::class, 'store']), $this->request)
            ->assertInvalid(['name', 'article_number', 'alternative_names', 'barcodes', 'user_id', 'genres'])
            ->assertRedirectToRoute('game-medias.create');

        $this->assertDatabaseMissing('game_medias', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_thumbnail_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('game-medias.create'));

        $this->request['thumbnail'] = UploadedFile::fake()->image('photo1.php');

        $this->actingAs($this->user)
            ->post(action([GameMediaController::class, 'store']), $this->request)
            ->assertInvalid(['thumbnail'])
            ->assertRedirectToRoute('game-medias.create');
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
                    [GameMediaController::class, 'update'],
                    [$this->gameMedia->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('game-medias.index')
            ->assertSessionHas('helper_flash_message', __('game_media.updated'));

        $this->assertDatabaseHas('game_medias', [
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
            ->delete(action([GameMediaController::class, 'destroy'], [$this->gameMedia->slug]))
            ->assertRedirectToRoute('game-medias.index')
            ->assertSessionHas('helper_flash_message', __('game_media.deleted'));

        $this->assertDatabaseMissing('game_medias', [
            'name' => $this->gameMedia->name,
            'deleted_at' => null
        ]);
    }
}
