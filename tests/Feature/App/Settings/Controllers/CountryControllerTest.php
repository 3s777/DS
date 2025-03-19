<?php

namespace App\Settings\Controllers;

use App\Http\Controllers\Settings\Admin\CountryController;
use App\Http\Requests\Settings\Admin\CreateCountryRequest;
use Database\Factories\Settings\CountryFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Settings\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CountryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Country $country;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->country = CountryFactory::new()->create();

        $this->request = CreateCountryRequest::factory()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([CountryController::class, $action], $params), $request)
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
        $this->checkNotAuthRedirect('edit', 'get', [$this->country->slug]);
        $this->checkNotAuthRedirect('store', 'post', [$this->country->slug], $this->request);
        $this->checkNotAuthRedirect('update', 'put', [$this->country->slug], $this->request);
        $this->checkNotAuthRedirect('destroy', 'delete', [$this->country->slug]);
    }

    /**
     * @test
     * @return void
     */
    public function it_index_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([CountryController::class, 'index']))
            ->assertOk()
            ->assertSee(__('settings.country.list'))
            ->assertViewIs('admin.settings.country.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_create_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([CountryController::class, 'create']))
            ->assertOk()
            ->assertSee(__('settings.country.add'))
            ->assertViewIs('admin.settings.country.create');
    }

    /**
     * @test
     * @return void
     */
    public function it_edit_success(): void
    {
        $this->actingAs($this->user)
            ->get(action([CountryController::class, 'edit'], [$this->country->slug]))
            ->assertOk()
            ->assertSee($this->country->name)
            ->assertViewIs('admin.settings.country.edit');
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {
        $this->actingAs($this->user)
            ->post(action([CountryController::class, 'store']), $this->request)
            ->assertRedirectToRoute('admin.countries.index')
            ->assertSessionHas('helper_flash_message', __('settings.country.created'));

        $this->assertDatabaseHas('countries', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_name_fail(): void
    {
        $this->app['session']->setPreviousUrl(route('admin.countries.create'));

        $this->request['name'] = '';

        $this->actingAs($this->user)
            ->post(action([CountryController::class, 'store']), $this->request)
            ->assertInvalid(['name'])
            ->assertRedirectToRoute('admin.countries.create');

        $this->assertDatabaseMissing('countries', [
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

        $this->actingAs($this->user)
            ->put(
                action(
                    [CountryController::class, 'update'],
                    [$this->country->slug]
                ),
                $this->request
            )
            ->assertRedirectToRoute('admin.countries.index')
            ->assertSessionHas('helper_flash_message', __('settings.country.updated'));

        $this->assertDatabaseHas('countries', [
            'slug' => Str::slug($this->request['name'])
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_success(): void
    {
        $this->actingAs($this->user)
            ->delete(action([CountryController::class, 'destroy'], [$this->country->slug]))
            ->assertRedirectToRoute('admin.countries.index')
            ->assertSessionHas('helper_flash_message', __('settings.country.deleted'));

        $this->assertDatabaseMissing('countries', [
            'slug' => Str::slug($this->request['name']),
            'deleted_at' => null
        ]);
    }
}
