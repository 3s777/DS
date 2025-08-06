<?php

namespace App\Game\Controllers;

use App\Http\Controllers\Game\Admin\GameMediaVariationController;
use App\Http\Requests\Game\Admin\CreateGameMediaVariationRequest;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Database\Factories\Auth\UserFactory;
use Database\Factories\Game\GameMediaVariationFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMediaVariation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GameMediaVariationControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected GameMediaVariation $gameMediaVariation;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->gameMediaVariation = GameMediaVariationFactory::new()->create();

        $this->request = CreateGameMediaVariationRequest::factory()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([GameMediaVariationController::class, $action], $params), $request)
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
        $this->checkNotAuthRedirect('edit', 'get', [$this->gameMediaVariation->slug]);
        $this->checkNotAuthRedirect('store', 'post');
        $this->checkNotAuthRedirect('update', 'put', [$this->gameMediaVariation->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->gameMediaVariation->slug]);
    }

    /**
     * @test
     * @return void
     */
    public function it_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameMediaVariationController::class, 'index']))
            ->assertOk()
            ->assertSee(__('collectible.variation.list'))
            ->assertViewIs('admin.game.variation.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameMediaVariationController::class, 'create']))
            ->assertOk()
            ->assertSee(__('collectible.variation.add'))
            ->assertViewIs('admin.game.variation.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([GameMediaVariationController::class, 'edit'], [$this->gameMediaVariation->slug]))
            ->assertOk()
            ->assertSee($this->gameMediaVariation->name)
            ->assertViewIs('admin.game.variation.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {
        $this->actingAs($this->user)
            ->post(action([GameMediaVariationController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.game-media-variations.index')
            ->assertSessionHas('helper_flash_message', __('collectible.variation.created'));

        $this->assertDatabaseHas('game_media_variations', [
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
            ->post(action([GameMediaVariationController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.game-media-variations.index')
            ->assertSessionHas('helper_flash_message', __('collectible.variation.created'));

        $this->assertDatabaseHas('game_media_variations', [
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
        $this->app['session']->setPreviousUrl(route('admin.game-media-variations.create'));

        $this->request['name'] = '';
        $this->request['article_number'] = ['fake', 'fake 2'];
        $this->request['alternative_names'] = ['fake', 'fake 2'];
        $this->request['barcodes'] = ['fake', 'fake 2'];
        $this->request['user_id'] = 1500000;
        $this->request['is_main'] = 1500000;
        $this->request['game_media_id'] = 'fake';

        $this->actingAs($this->user)
            ->post(action([GameMediaVariationController::class, 'store']), $this->request)
            ->assertInvalid([
                'name',
                'article_number',
                'alternative_names',
                'barcodes',
                'user_id',
                'is_main',
                'game_media_id',
            ])
            ->assertRedirectToRoute('admin.game-media-variations.create');

        $this->assertDatabaseMissing('game_media_variations', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_featured_image_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.game-media-variations.create'));

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.php');

        $this->actingAs($this->user)
            ->post(action([GameMediaVariationController::class, 'store']), $this->request)
            ->assertInvalid(['featured_image'])
            ->assertRedirectToRoute('admin.game-media-variations.create');
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
                    [GameMediaVariationController::class, 'update'],
                    [$this->gameMediaVariation->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.game-media-variations.index')
            ->assertSessionHas('helper_flash_message', __('collectible.variation.updated'));

        $this->assertDatabaseHas('game_media_variations', [
            'name' => $this->request['name']
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_update_validation_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.game-media-variations.edit', $this->gameMediaVariation->slug));

        $this->request['name'] = '';
        $this->request['article_number'] = ['fake', 'fake 2'];
        $this->request['alternative_names'] = ['fake', 'fake 2'];
        $this->request['barcodes'] = ['fake', 'fake 2'];
        $this->request['user_id'] = 1500000;
        $this->request['is_main'] = 1500000;
        $this->request['game_media_id'] = 1500000;

        $this->actingAs($this->user)
            ->put(
                action(
                    [GameMediaVariationController::class, 'update'],
                    [$this->gameMediaVariation->slug]
                ),
                $this->request
            )
            ->assertInvalid([
                'name',
                'article_number',
                'alternative_names',
                'barcodes',
                'user_id',
                'is_main',
                'game_media_id'
                ])
            ->assertRedirectToRoute('admin.game-media-variations.edit', $this->gameMediaVariation->slug);
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_success(): void
    {
        $this->actingAs($this->user)
            ->delete(action([GameMediaVariationController::class, 'destroy'], [$this->gameMediaVariation->slug]))
            ->assertRedirectToRoute('admin.game-media-variations.index')
            ->assertSessionHas('helper_flash_message', __('collectible.variation.deleted'));

        $this->assertDatabaseMissing('game_media_variations', [
            'name' => $this->gameMediaVariation->name,
            'deleted_at' => null
        ]);
    }
}
