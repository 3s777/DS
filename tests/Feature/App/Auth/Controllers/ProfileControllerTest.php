<?php

namespace App\Auth\Controllers;

use App\Http\Controllers\Auth\Collector\ProfileController;
use App\Http\Requests\Auth\UpdateCollectorProfileRequest;
use App\Jobs\Support\GenerateSmallThumbnailsJob;
use App\Jobs\Support\GenerateThumbnailJob;
use Database\Factories\Auth\CollectorFactory;
use Domain\Auth\Models\Collector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Collector $authCollector;
    protected Collector $testingCollector;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('images');

        $this->authCollector = CollectorFactory::new()->create();

        $this->testingCollector = CollectorFactory::new()->create();

        $this->request = UpdateCollectorProfileRequest::factory()->create();
    }

    public function checkNotAuthRedirect(
        string $action,
        string $method = 'get',
        array $params = [],
        array $request = []
    ): void {
        $this->{$method}(action([ProfileController::class, $action], $params), $request)
            ->assertRedirectToRoute('collector.login');
    }

    public function test_pages_only_auth_success(): void
    {
        $this->checkNotAuthRedirect('show');
        $this->checkNotAuthRedirect('settings');
        $this->checkNotAuthRedirect('confidential');
    }

    public function test_index_success(): void
    {
        $this->actingAs($this->authCollector, 'collector')
            ->get(action([ProfileController::class, 'show']))
            ->assertOk()
            ->assertSee($this->authCollector->first_name)
            ->assertSee(__('user.profile.info'))
            ->assertViewIs('content.profile.index');
    }

    public function test_settings_success(): void
    {
        $this->actingAs($this->authCollector, 'collector')
            ->get(action([ProfileController::class, 'settings']))
            ->assertOk()
            ->assertSee($this->authCollector->first_name)
            ->assertSee($this->authCollector->email)
            ->assertSee(__('user.profile.settings'))
            ->assertViewIs('content.profile.settings');
    }

    public function test_confidential_success(): void
    {
        $this->actingAs($this->authCollector, 'collector')
            ->get(action([ProfileController::class, 'confidential']))
            ->assertOk()
            ->assertSee(__('user.profile.settings_confidential'))
            ->assertViewIs('content.profile.confidential');
    }

    public function test_update_success(): void
    {
        $this->actingAs($this->authCollector, 'collector')
            ->put(route('profile.settings.update'), $this->request)
            ->assertRedirectToRoute('profile.settings')
            ->assertSessionHas('helper_flash_message', __('user.profile.updated'));

        $this->assertSame($this->authCollector->first_name, $this->request['first_name']);
        $this->assertNotSame($this->authCollector->name, $this->request['name']);
        $this->assertNotSame($this->authCollector->email, $this->request['email']);
        $this->assertSame($this->authCollector->description, $this->request['description']);
        $this->assertSame($this->authCollector->language, $this->request['language']);
        $this->assertNotSame($this->authCollector->password, $this->request['password']);

        $this->assertDatabaseHas('collectors', [
            'first_name' => $this->request['first_name']
        ]);
    }

    public function test_update_password_failed(): void
    {
        $this->request['current_password'] = 'wrong_password';
        $this->request['new_password'] = 'new_password';
        $this->request['new_password_confirmation'] = 'new_password';

        $this->actingAs($this->authCollector, 'collector')
            ->put(route('profile.settings.update'), $this->request)
            ->assertInvalid(['current_password'])
            ->assertRedirectToRoute('profile.settings');
    }

    public function test_update_password_success(): void
    {
        $this->request['current_password'] = '123456789q';
        $this->request['new_password'] = '123456789qq';
        $this->request['new_password_confirmation'] = '123456789qq';

        $authCollector = CollectorFactory::new()->create(['password' => bcrypt('123456789q')]);

        $this->actingAs($authCollector, 'collector')
            ->put(route('profile.settings.update'), $this->request)
            ->assertRedirectToRoute('profile.settings')
            ->assertSessionHas('helper_flash_message', __('user.profile.updated').'. '.__('auth.password_updated'));

        $this->assertTrue(Hash::check('123456789qq', $authCollector->password));
    }

    public function test_update_validation_fail(): void
    {
        $this->request['language'] = 'unknown';
        $this->request['first_name'] = ['fake', 'fake 2'];

        $this->actingAs($this->authCollector, 'collector')
            ->put(
                action(
                    [ProfileController::class, 'updateSettings']
                ),
                $this->request
            )
            ->assertInvalid(['first_name', 'language'])
            ->assertRedirectToRoute('profile.settings');
    }

    public function test_update_with_image_success(): void
    {
        Queue::fake();
        Storage::fake('images');

        $this->request['featured_image'] = UploadedFile::fake()->image('photo1.jpg');

        $this->actingAs($this->authCollector, 'collector')
            ->put(
                action(
                    [ProfileController::class, 'updateSettings']
                ),
                $this->request
            )
            ->assertRedirectToRoute('profile.settings')
            ->assertSessionHas('helper_flash_message', __('user.profile.updated'));

        Queue::assertPushed(GenerateThumbnailJob::class, 3);

        Queue::assertPushed(GenerateSmallThumbnailsJob::class, 2);
    }
}
