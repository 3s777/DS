<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\SignInController;
use App\Http\Requests\SignInRequest;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SignInControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_page_success(): void
    {
        $this->get(action([SignInController::class, 'page']))
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
        $password = '123456789q';

        $user = UserFactory::new()->create([
            'password' => bcrypt($password)
        ]);

        $request = SignInRequest::factory()->create([
            'username' => $user->email,
            'password' => $password
        ]);

        $response = $this->post(action([SignInController::class, 'handle']), $request);

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
        $request = SignInRequest::factory()->create([
            'username' => 'test@notexist.com',
            'password' => str()->random(10)
        ]);

        $this->post(action([SignInController::class, 'handle']), $request)
            ->assertInvalid(['username']);

        $this->assertGuest();
    }


    /**
     * @test
     * @return void
     */
    public function it_logout_success(): void
    {
        $user = UserFactory::new()->create();

        $this->actingAs($user)->delete(action([SignInController::class, 'logout']));

        $this->assertGuest();
    }

    /**
     * @test
     * @return void
     */
    public function it_logout_guest_middleware_fail(): void
    {
        $this->delete(action([SignInController::class, 'logout']))
            ->assertRedirect('/');
    }

}
