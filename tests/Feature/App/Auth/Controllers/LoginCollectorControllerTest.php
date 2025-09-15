<?php

namespace App\Auth\Controllers;

use App\Http\Controllers\Auth\LoginCollectorController;
use Database\Factories\Auth\CollectorFactory;
use Domain\Auth\Models\Collector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginCollectorControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Collector $collector;
    protected string $password = '123456789';
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->collector = CollectorFactory::new()->create([
            'password' => bcrypt($this->password),
        ]);

        $this->request = [
            'email' => $this->collector->email,
            'password' => $this->password,
        ];
    }

    public function test_page_success(): void
    {
        $this->get(action([LoginCollectorController::class, 'page']))
            ->assertOk()
            ->assertSee(__('auth.login'))
            ->assertViewIs('content.auth-collector.login');

    }

    public function test_only_guest_success(): void
    {
        $this->post(action([LoginCollectorController::class, 'handle']), $this->request);

        $this->get(action([LoginCollectorController::class, 'page']))
            ->assertRedirect('/');
    }

    public function test_handle_success(): void
    {
        $response = $this->post(action([LoginCollectorController::class, 'handle']), $this->request);

        $response->assertValid()
            ->assertRedirectToRoute('search');

        $this->assertAuthenticatedAs($this->collector, 'collector');
    }

    public function test_handle_fail(): void
    {
        $request = [
            'email' => 'test@notexist.com',
            'password' => str()->random(10),
        ];

        $this->post(action([LoginCollectorController::class, 'handle']), $request)
            ->assertSessionHas('helper_flash_message', __('auth.error.credentials'));

        $this->assertGuest();
    }

    public function test_not_verified_fail(): void
    {
        $user = CollectorFactory::new()->create([
            'password' => bcrypt($this->password),
            'email_verified_at' => null,
        ]);

        $request = [
            'email' => $user->email,
            'password' => $this->password
        ];

        $this->post(action([LoginCollectorController::class, 'handle']), $request)
            ->assertRedirectToRoute('collector.verification.notice');

        $this->assertGuest('collector');
    }

    public function test_logout_success(): void
    {
        $collector = CollectorFactory::new()->create();

        $this->actingAs($collector)->delete(action([LoginCollectorController::class, 'logout']));

        $this->assertGuest('collector');
    }

    public function test_logout_guest_middleware_fail(): void
    {
        $this->delete(action([LoginCollectorController::class, 'logout']))
            ->assertRedirectToRoute('home');
    }

}
