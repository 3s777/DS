<?php

namespace App\Auth\Controllers;

use App\Http\Controllers\Auth\LoginAdminController;
use Database\Factories\Auth\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected string $password = '123456789';
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create([
            'password' => bcrypt($this->password),
        ]);

        $this->request = [
            'email' => $this->user->email,
            'password' => $this->password,
        ];
    }

    public function test_page_success(): void
    {
        $this->get(action([LoginAdminController::class, 'page']))
            ->assertOk()
            ->assertSee(__('auth.login'))
            ->assertViewIs('content.auth.login');

    }

    public function test_only_guest_success(): void
    {
        $this->post(action([LoginAdminController::class, 'handle']), $this->request);

        $this->get(action([LoginAdminController::class, 'page']))
            ->assertRedirect('/');
    }

    public function test_handle_success(): void
    {
        $response = $this->post(action([LoginAdminController::class, 'handle']), $this->request);

        $response->assertValid()
            ->assertRedirectToRoute('search');

        $this->assertAuthenticatedAs($this->user);
    }

    public function test_handle_fail(): void
    {
        $request = [
            'email' => 'test@notexist.com',
            'password' => str()->random(10),
        ];

        $this->post(action([LoginAdminController::class, 'handle']), $request)
            ->assertSessionHas('helper_flash_message', __('auth.error.credentials'));

        $this->assertGuest();
    }

    public function test_not_verified_fail(): void
    {
        $user = UserFactory::new()->create([
            'password' => bcrypt($this->password),
            'email_verified_at' => null,
        ]);

        $request = [
            'email' => $user->email,
            'password' => $this->password
        ];

        $this->post(action([LoginAdminController::class, 'handle']), $request)
            ->assertRedirectToRoute('admin.verification.notice');

        $this->assertGuest();
    }

    public function test_logout_success(): void
    {
        $user = UserFactory::new()->create();

        $this->actingAs($user)->delete(action([LoginAdminController::class, 'logout']));

        $this->assertGuest();
    }

    public function test_logout_guest_middleware_fail(): void
    {
        $this->delete(action([LoginAdminController::class, 'logout']))
            ->assertRedirectToRoute('home');
    }

}
