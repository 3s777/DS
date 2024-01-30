<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\Auth\RegisterRequest;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = RegisterRequest::factory()->create();
    }

    private function postRequest(): TestResponse
    {
        return $this->post(
            action([RegisterController::class, 'handle']),
            $this->request
        );
    }

    private function findUser(): User
    {
        return User::where('email', $this->request['email'])->first();
    }

    /**
     * @test
     * @return void
     */
    public function it_page_success(): void
    {
        $this->get(action([RegisterController::class, 'page']))
            ->assertOk()
            ->assertSee(__('auth.register'))
            ->assertViewIs('content.auth.register');
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_success(): void
    {
        $this->postRequest()
            ->assertValid();
    }

    /**
     * @test
     * @return void
     */
    public function it_should_fail_validation_on_password_confirm(): void
    {
        $this->request['password'] = '123';
        $this->request['password_confirmation'] = '1234';

        $this->postRequest()
            ->assertInvalid(['password']);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_fail_validation_on_password(): void
    {
        $this->request['password'] = '123';
        $this->request['password_confirmation'] = '123';

        $this->postRequest()
            ->assertInvalid(['password']);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_fail_validation_on_unique_email(): void
    {
        UserFactory::new()->create([
            'email' => $this->request['email']
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $this->request['email']
        ]);

        $this->postRequest()
            ->assertInvalid(['email']);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_fail_validation_on_unique_username(): void
    {
        UserFactory::new()->create([
            'name' => $this->request['name']
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $this->request['name']
        ]);

        $this->postRequest()
            ->assertInvalid(['name']);
    }

    /**
     * @test
     * @return void
     */
    public function it_redirect_to_login(): void
    {
        $response = $this->post(
                action([RegisterController::class, 'handle']),
                $this->request
        );

        $response->assertValid()
            ->assertRedirect(route('login'))
            ->assertSessionHas('helper_flash_message', __('auth.register_verify'));

        $this->followRedirects($response)->assertSee(__('auth.register_verify'));
    }

    /**
     * @test
     * @return void
     */
    public function it_only_guest_success(): void
    {
        $password = '123456789';

        $user = UserFactory::new()->create([
            'password' => bcrypt($password),
        ]);

        $request = [
            'email' => $user->email,
            'password' => $password,
        ];

        $this->post(action([LoginController::class, 'handle']), $request);

        $this->get(action([RegisterController::class, 'page']))
            ->assertRedirect('/');
    }
}
