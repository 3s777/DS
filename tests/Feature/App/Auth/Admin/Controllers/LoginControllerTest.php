<?php

namespace App\Auth\Admin\Controllers;

use App\Http\Controllers\Auth\Public\Admin\LoginController;
use Database\Factories\UserFactory;
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

    /**
     * @test
     * @return void
     */
    public function it_page_success(): void
    {
        $this->get(action([LoginController::class, 'page']))
            ->assertOk()
            ->assertSee(__('auth.login'))
            ->assertViewIs('content.auth.login');

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

        $this->assertAuthenticatedAs($this->user);
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
        $user = UserFactory::new()->create([
            'password' => bcrypt($this->password),
            'email_verified_at' => null,
        ]);

        $request = [
            'email' => $user->email,
            'password' => $this->password
        ];

        $this->post(action([LoginController::class, 'handle']), $request)
            ->assertRedirectToRoute('admin.verification.notice');

        $this->assertGuest();
    }

    /**
     * @test
     * @return void
     */
    public function it_logout_success(): void
    {
        $user = UserFactory::new()->create();

        $this->actingAs($user)->delete(action([LoginController::class, 'logout']));

        $this->assertGuest();
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
