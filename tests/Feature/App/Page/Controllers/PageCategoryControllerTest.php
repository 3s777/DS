<?php

namespace App\Page\Controllers;

use App\Http\Controllers\Page\Admin\PageCategoryController;
use App\Http\Requests\Page\Admin\CreatePageCategoryRequest;
use Database\Factories\Auth\UserFactory;
use Database\Factories\Page\PageCategoryFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Page\Models\PageCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class PageCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected PageCategory $pageCategory;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->pageCategory = PageCategoryFactory::new()->create();

        $this->request = CreatePageCategoryRequest::factory()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([PageCategoryController::class, $action], $params), $request)
            ->assertRedirectToRoute('admin.login');
    }

    public function test_pages_success(): void
    {
        $this->checkNotAuthRedirect('index');
        $this->checkNotAuthRedirect('create');
        $this->checkNotAuthRedirect('edit', 'get', [$this->pageCategory->slug]);
        $this->checkNotAuthRedirect('store', 'post');
        $this->checkNotAuthRedirect('update', 'put', [$this->pageCategory->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->pageCategory->slug]);
    }

    public function test_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([PageCategoryController::class, 'index']))
            ->assertOk()
            ->assertSee(__('page.category.list'))
            ->assertViewIs('admin.page.category.index');
    }

    public function test_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([PageCategoryController::class, 'create']))
            ->assertOk()
            ->assertSee(__('page.category.add'))
            ->assertViewIs('admin.page.category.create');
    }

    public function test_edtest_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([PageCategoryController::class, 'edit'], [$this->pageCategory->slug]))
            ->assertOk()
            ->assertSee($this->pageCategory->name)
            ->assertViewIs('admin.page.category.edit');
    }

    public function test_store_success(): void
    {
        $this->actingAs($this->user)
            ->post(action([PageCategoryController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.page-categories.index')
            ->assertSessionHas('helper_flash_message', __('page.category.created'));

        $this->assertDatabaseHas('page_categories', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    public function test_validation_name_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.page-categories.create'));

        $this->request['name'] = '';
        $this->request['slug'] = [];
        $this->request['user_id'] = 1500000;

        $this->actingAs($this->user)
            ->post(action([PageCategoryController::class, 'store']), $this->request)
            ->assertInvalid([
                'name',
                'slug',
                'user_id',
            ])
            ->assertRedirectToRoute('admin.page-categories.create');

        $this->assertDatabaseMissing('page_categories', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    public function test_update_success(): void
    {
        $this->request['name'] = 'newName';

        $this->actingAs($this->user)
            ->put(
                action(
                    [PageCategoryController::class, 'update'],
                    [$this->pageCategory->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.page-categories.index')
            ->assertSessionHas('helper_flash_message', __('page.category.updated'));

        $this->assertDatabaseHas('page_categories', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    public function test_update_validation_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.page-categories.edit', $this->pageCategory->slug));

        $this->request['name'] = '';
        $this->request['slug'] = [];
        $this->request['user_id'] = 1500000;

        $this->actingAs($this->user)
            ->put(
                action(
                    [PageCategoryController::class, 'update'],
                    [$this->pageCategory->slug]
                ),
                $this->request
            )
            ->assertInvalid(
                [
                    'name',
                    'slug',
                    'user_id',
                ]
            )
            ->assertRedirectToRoute('admin.page-categories.edit', $this->pageCategory->slug);
    }

    public function test_delete_success(): void
    {
        $this->actingAs($this->user)
            ->delete(action([PageCategoryController::class, 'destroy'], [$this->pageCategory->slug]))
            ->assertRedirectToRoute('admin.page-categories.index')
            ->assertSessionHas('helper_flash_message', __('page.category.deleted'));

        $this->assertDatabaseMissing('page_categories', [
            'slug' => Str::slug($this->request['name']),
            'deleted_at' => null
        ]);
    }
}
