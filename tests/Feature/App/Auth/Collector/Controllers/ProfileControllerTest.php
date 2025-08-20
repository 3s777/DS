<?php

namespace App\Auth\Collector\Controllers;

use App\Http\Controllers\Auth\Public\Collector\ProfileController;
use App\Http\Requests\Auth\Admin\CreateCollectorRequest;
use Database\Factories\Auth\CollectorFactory;
use Domain\Auth\Models\Collector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Collector $authCollector;
    protected Collector $testingCollector;
//    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->authCollector = CollectorFactory::new()->create();

        $this->testingCollector = CollectorFactory::new()->create();

//        $this->request = CreateCollectorRequest::factory()->create();
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

//    public function test_not_auth_failed(): void
//    {
//        $this->get(action([ProfileController::class, 'show']))
//            ->assertRedirectToRoute('collector.login');
//    }

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
}
