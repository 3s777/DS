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

    public function test_index_success(): void
    {
        $this->actingAs($this->authCollector, 'collector')
            ->get(action([ProfileController::class, 'show']))
            ->assertOk()
            ->assertSee($this->authCollector->name)
            ->assertSee(__('user.profile.info'))
            ->assertViewIs('content.profile.index');
    }

    public function test_not_auth_failed(): void
    {
        $this->get(action([ProfileController::class, 'show']))
            ->assertRedirectToRoute('collector.login');
    }
}
