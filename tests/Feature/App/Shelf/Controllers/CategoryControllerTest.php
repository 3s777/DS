<?php

namespace App\Shelf\Controllers;

use App\Http\Controllers\Shelf\Admin\CategoryController;
use App\Http\Requests\Shelf\Admin\CreateCategoryRequest;
use Database\Factories\Shelf\CategoryFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Shelf\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Category $category;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->category = CategoryFactory::new()->create();

        $this->request = CreateCategoryRequest::factory()->create(['model' => 'game_media']);
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([CategoryController::class, $action], $params), $request)
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
        $this->checkNotAuthRedirect('edit', 'get', [$this->category->slug]);
        $this->checkNotAuthRedirect('store', 'post', [$this->category->slug], $this->request);
        $this->checkNotAuthRedirect('update', 'put', [$this->category->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->category->slug]);
    }

    /**
     * @test
     * @return void
     */
    public function it_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([CategoryController::class, 'index']))
            ->assertOk()
            ->assertSee(__('collectible.category.list'))
            ->assertViewIs('admin.shelf.category.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([CategoryController::class, 'create']))
            ->assertOk()
            ->assertSee(__('collectible.category.add'))
            ->assertViewIs('admin.shelf.category.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([CategoryController::class, 'edit'], [$this->category->slug]))
            ->assertOk()
            ->assertSee($this->category->name)
            ->assertViewIs('admin.shelf.category.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {

        $this->actingAs($this->user)
            ->post(action([CategoryController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.categories.index')
            ->assertSessionHas('helper_flash_message', __('collectible.category.created'));

        $this->assertDatabaseHas('categories', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_name_fail(): void
    {

        $this->app['session']->setPreviousUrl(route('admin.categories.create'));

        $this->request['name'] = '';

        $this->actingAs($this->user)
            ->post(action([CategoryController::class, 'store']), $this->request)
            ->assertInvalid(['name'])
            ->assertRedirectToRoute('admin.categories.create');

        $this->assertDatabaseMissing('categories', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_update_success(): void
    {
        $this->request['name'] = 'newName';
        $this->request['description'] = 'new Description';

        $this->actingAs($this->user)
            ->put(
                action(
                    [CategoryController::class, 'update'],
                    [$this->category->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.categories.index')
            ->assertSessionHas('helper_flash_message', __('collectible.category.updated'));

        $this->assertDatabaseHas('categories', [
            'slug' => Str::slug($this->request['name']),
        ]);

        $updatedCategory = Category::where(['slug' => Str::slug($this->request['name'])])->first();

        $this->assertSame('new Description', $updatedCategory->description);
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_success(): void
    {
        $this->actingAs($this->user)
            ->delete(action([CategoryController::class, 'destroy'], [$this->category->slug]))
            ->assertRedirectToRoute('admin.categories.index')
            ->assertSessionHas('helper_flash_message', __('collectible.category.deleted'));

        $this->assertDatabaseMissing('categories', [
            'slug' => Str::slug($this->request['name']),
            'deleted_at' => null
        ]);

        $this->category->refresh();
        $this->assertNull($this->category->model);
    }
}
