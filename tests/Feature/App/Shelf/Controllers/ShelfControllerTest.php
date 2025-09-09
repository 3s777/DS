<?php

namespace App\Shelf\Controllers;

use App\Http\Controllers\Shelf\Admin\ShelfController;
use App\Http\Requests\Shelf\Admin\CreateShelfRequest;
use App\Jobs\Support\GenerateSmallThumbnailsJob;
use App\Jobs\Support\GenerateThumbnailJob;
use Database\Factories\Auth\UserFactory;
use Database\Factories\Shelf\ShelfFactory;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Shelf\Models\Shelf;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

// TODO: add policy tests
class ShelfControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Shelf $shelf;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->shelf = ShelfFactory::new()->create();

        $this->request = CreateShelfRequest::factory()->create();
        $this->request['collector_id'] = Collector::factory()->create()->id;
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([ShelfController::class, $action], $params), $request)
            ->assertRedirectToRoute('admin.login');
    }

//    public function test_pages_success(): void
//    {
//        $this->checkNotAuthRedirect('index');
//        $this->checkNotAuthRedirect('create');
//        $this->checkNotAuthRedirect('edit', 'get', [$this->shelf->id]);
//        $this->checkNotAuthRedirect('store', 'post', [$this->shelf->id], $this->request);
//        $this->checkNotAuthRedirect('update', 'put', [$this->shelf->id], $this->request);
//        $this->checkNotAuthRedirect('destroy', 'delete', [$this->shelf->id]);
//    }

    public function test_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([ShelfController::class, 'index']))
            ->assertOk()
            ->assertSee(__('shelf.list'))
            ->assertViewIs('admin.shelf.shelf.index');
    }

    public function test_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([ShelfController::class, 'create']))
            ->assertOk()
            ->assertSee(__('shelf.add'))
            ->assertViewIs('admin.shelf.shelf.create');
    }

    public function test_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([ShelfController::class, 'edit'], [$this->shelf->id]))
            ->assertOk()
            ->assertSee($this->shelf->name)
            ->assertViewIs('admin.shelf.shelf.edit');
    }

    public function test_store_success(): void
    {

        $this->actingAs($this->user)
            ->post(action([ShelfController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.shelves.index')
            ->assertSessionHas('helper_flash_message', __('shelf.created'));

        $this->assertDatabaseHas('shelves', [
            'name' => $this->request['name']
        ]);
    }

    public function test_store_with_image_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $this->actingAs($this->user)
            ->post(action([ShelfController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.shelves.index')
            ->assertSessionHas('helper_flash_message', __('shelf.created'));

        $this->assertDatabaseHas('shelves', [
            'name' => $this->request['name']
        ]);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    public function test_validation_name_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.shelves.create'));

        $this->request['name'] = '';
        $this->request['number'] = 'not_numbers';

        $this->actingAs($this->user)
            ->post(action([ShelfController::class, 'store']), $this->request)
            ->assertInvalid(['name', 'number'])
            ->assertRedirectToRoute('admin.shelves.create');

        $this->assertDatabaseMissing('shelves', [
            'name' => $this->request['name']
        ]);
    }

    public function test_validation_featured_image_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.shelves.create'));

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.php');

        $this->actingAs($this->user)
            ->post(action([ShelfController::class, 'store']), $this->request)
            ->assertInvalid(['featured_image'])
            ->assertRedirectToRoute('admin.shelves.create');
    }

    public function test_update_success(): void
    {
        $this->request['name'] = 'newName';

        $this->actingAs($this->user)
            ->put(
                action(
                    [ShelfController::class, 'update'],
                    [$this->shelf->id]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.shelves.index')
            ->assertSessionHas('helper_flash_message', __('shelf.updated'));

        $this->assertDatabaseHas('shelves', [
            'name' => $this->request['name']
        ]);
    }

    public function test_delete_success(): void
    {
        $this->actingAs($this->user)
            ->delete(action([ShelfController::class, 'destroy'], [$this->shelf->id]))
            ->assertRedirectToRoute('admin.shelves.index')
            ->assertSessionHas('helper_flash_message', __('shelf.deleted'));

        $this->assertDatabaseMissing('shelves', [
            'name' => $this->shelf->id,
            'deleted_at' => null
        ]);
    }

    public function test_fail_wrong_depended_get_for_select(): void
    {
        $this->actingAs($this->user)
            ->post(action([ShelfController::class, 'getForSelect'], ['depended' => ['wrong_field_id' => $this->user->id]]))
            ->assertJson(['result' => [
                ['value' => '', 'label' => trans_choice('shelf.choose', 1), 'disabled' => true],
                ['value' => 'not_found', 'label' => __('common.not_found'), 'disabled' => true]
            ]])
            ->assertOk();
    }

    public function test_success_get_for_select(): void
    {
        $collector = Collector::factory()->create();
        $shelf = Shelf::factory()->create(['collector_id' => $collector->id]);

        $this->actingAs($this->user)
            ->post(action([ShelfController::class, 'getForSelect'], ['depended' => ['collector_id' => $collector->id]]))
            ->assertJson(['result' => [
                ['value' => '', 'label' => trans_choice('shelf.choose', 1), 'disabled' => true],
                ['value' => $shelf->id, 'label' => $shelf->name]
            ]])
            ->assertOk();
    }
}
