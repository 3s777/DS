<?php

namespace App\Page\Controllers;

use App\Http\Controllers\Page\Admin\PageController;
use App\Http\Requests\Page\Admin\CreatePageRequest;
use App\Jobs\Support\GenerateSmallThumbnailsJob;
use App\Jobs\Support\GenerateThumbnailJob;
use Database\Factories\Auth\UserFactory;
use Database\Factories\Page\PageFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Page\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Page $page;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->page = PageFactory::new()->create();

        $this->request = CreatePageRequest::factory()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([PageController::class, $action], $params), $request)
            ->assertRedirectToRoute('admin.login');
    }

    public function test_pages_success(): void
    {
        $this->checkNotAuthRedirect('index');
        $this->checkNotAuthRedirect('create');
        $this->checkNotAuthRedirect('edit', 'get', [$this->page->slug]);
        $this->checkNotAuthRedirect('store', 'post');
        $this->checkNotAuthRedirect('update', 'put', [$this->page->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->page->slug]);
    }

    public function test_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([PageController::class, 'index']))
            ->assertOk()
            ->assertSee(__('page.list'))
            ->assertViewIs('admin.page.page.index');
    }

    public function test_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([PageController::class, 'create']))
            ->assertOk()
            ->assertSee(__('page.add'))
            ->assertViewIs('admin.page.page.create');
    }

    public function test_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([PageController::class, 'edit'], [$this->page->slug]))
            ->assertOk()
            ->assertSee($this->page->name)
            ->assertViewIs('admin.page.page.edit');
    }

    public function test_store_success(): void
    {

        $this->actingAs($this->user)
            ->post(action([PageController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.pages.index')
            ->assertSessionHas('helper_flash_message', __('page.created'));

        $this->assertDatabaseHas('pages', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    public function test_store_with_image_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $this->actingAs($this->user)
            ->post(action([PageController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.pages.index')
            ->assertSessionHas('helper_flash_message', __('page.created'));

        $this->assertDatabaseHas('pages', [
            'slug' => Str::slug($this->request['name'])
        ]);

        Queue::assertPushed(GenerateThumbnailJob::class, 3);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }

    public function test_validation_featured_image_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.pages.create'));

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.php');

        $this->actingAs($this->user)
            ->post(action([PageController::class, 'store']), $this->request)
            ->assertInvalid(['featured_image'])
            ->assertRedirectToRoute('admin.pages.create');
    }

    public function test_validation_name_fail(): void
    {

        $this->app['session']->setPreviousUrl(route('admin.pages.create'));

        $this->request['name'] = '';

        $this->actingAs($this->user)
            ->post(action([PageController::class, 'store']), $this->request)
            ->assertInvalid(['name'])
            ->assertRedirectToRoute('admin.pages.create');

        $this->assertDatabaseMissing('pages', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    public function test_update_success(): void
    {
        $this->request['name'] = 'newName';
        $this->request['description'] = 'new Description';

        $this->actingAs($this->user)
            ->put(
                action(
                    [PageController::class, 'update'],
                    [$this->page->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.pages.index')
            ->assertSessionHas('helper_flash_message', __('page.updated'));

        $this->assertDatabaseHas('pages', [
            'slug' => Str::slug($this->request['name']),
        ]);

        $updatedPage = Page::where(['slug' => Str::slug($this->request['name'])])->first();

        $this->assertSame('new Description', $updatedPage->description);
    }

    public function test_delete_success(): void
    {
        $this->actingAs($this->user)
            ->delete(action([PageController::class, 'destroy'], [$this->page->slug]))
            ->assertRedirectToRoute('admin.pages.index')
            ->assertSessionHas('helper_flash_message', __('page.deleted'));

        $this->assertDatabaseMissing('pages', [
            'slug' => Str::slug($this->request['name']),
            'deleted_at' => null
        ]);
    }
}
