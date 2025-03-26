<?php

namespace App\Auth\Collector\Controllers;

use App\Http\Controllers\Auth\Public\Collector\LoginController;
use Database\Factories\CollectorFactory;
use Domain\Auth\Models\Collector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
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

    /**
     * @test
     * @return void
     */
    public function it_page_success(): void
    {
        $this->get(action([LoginController::class, 'page']))
            ->assertOk()
            ->assertSee(__('auth.login'))
            ->assertViewIs('content.auth-collector.login');

    }

    /**
     * @test
     * @return void
     */
    public function it_only_guest_success(): void
    {
        $this->post(action([LoginController::class, 'handle']), $this->request);

        $this->get(action([LoginController::class, 'page']))
            ->assertRedirect('/');
    }

    /**
     * @test
     * @return void
     */
    public function it_handle_success(): void
    {
        $response = $this->post(action([LoginController::class, 'handle']), $this->request);

        $response->assertValid()
            ->assertRedirectToRoute('search');

        $this->assertAuthenticatedAs($this->collector, 'collector');
    }

    /**
     * @test
     * @return void
     */
    public function it_handle_fail(): void
    {
        $request = [
            'email' => 'test@notexist.com',
            'password' => str()->random(10),
        ];

        $this->post(action([LoginController::class, 'handle']), $request)
            ->assertSessionHas('helper_flash_message', __('auth.error.credentials'));

        $this->assertGuest();
    }

    /**
     * @test
     * @return void
     */
    public function it_not_verified_fail(): void
    {
        $user = CollectorFactory::new()->create([
            'password' => bcrypt($this->password),
            'email_verified_at' => null,
        ]);

        $request = [
            'email' => $user->email,
            'password' => $this->password
        ];

        $this->post(action([LoginController::class, 'handle']), $request)
            ->assertRedirectToRoute('collector.verification.notice');

        $this->assertGuest('collector');
    }

    /**
     * @test
     * @return void
     */
    public function it_logout_success(): void
    {
        $collector = CollectorFactory::new()->create();

        $this->actingAs($collector)->delete(action([LoginController::class, 'logout']));

        $this->assertGuest('collector');
    }

    /**
     * @test
     * @return void
     */
    public function it_logout_guest_middleware_fail(): void
    {
        $this->delete(action([LoginController::class, 'logout']))
            ->assertRedirectToRoute('home');
    }

}
