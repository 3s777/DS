<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Models\Language;
use Database\Factories\LanguageFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_page_success(): void
    {
        $this->get(action([LoginController::class, 'page']))
            ->assertOk()
            ->assertSee('Войти')
            ->assertViewIs('content.auth.login');
    }

    /**
     * @test
     * @return void
     */
    public function it_handle_success(): void
    {
        LanguageFactory::new()->create();

        $password = '123456789';

        $user = UserFactory::new()->create([
            'password' => bcrypt($password)
        ]);

        $request = [
            'email' => $user->email,
            'password' => $password
        ];

        $response = $this->post(action([LoginController::class, 'handle']), $request);

        $response->assertValid()
            ->assertRedirect(route('search'));

        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     * @return void
     */
    public function it_handle_fail(): void
    {
        $request = [
            'email' => 'test@notexist.com',
            'password' => str()->random(10)
        ];

        $this->post(action([LoginController::class, 'handle']), $request)
            ->assertInvalid(['email']);

        $this->assertGuest();
    }

    /**
     * @test
     * @return void
     */
    public function it_not_verified_fail(): void
    {
        $password = '123456789q';

        $user = UserFactory::new()->create([
            'password' => bcrypt($password),
            'email_verified_at' => null
        ]);

        $request = [
            'email' => $user->email,
            'password' => $password
        ];

        $this->post(action([LoginController::class, 'handle']), $request)
            ->assertRedirect(route('verification.notice'));

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
            ->assertRedirect(route('home'));
    }

}
