<?php

namespace App\Auth\Controllers;

use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\Admin\RegisterController;
use App\Http\Requests\Auth\RegisterAdminRequest;
use Database\Factories\Auth\UserFactory;
use Domain\Auth\Models\Role;
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

        $this->request = RegisterAdminRequest::factory()->create();

        Role::create(['name' => config('settings.default_role'), 'display_name' => 'User']);

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

    public function test_page_success(): void
    {
        $this->get(action([RegisterController::class, 'page']))
            ->assertOk()
            ->assertSee(__('auth.register'))
            ->assertViewIs('content.auth.register');
    }

    public function test_validation_success(): void
    {
        $this->postRequest()
            ->assertValid();
    }

    public function test_should_fail_validation_on_password_confirm(): void
    {
        $this->request['password'] = '123';
        $this->request['password_confirmation'] = '1234';

        $this->postRequest()
            ->assertInvalid(['password']);
    }

    public function test_should_fail_validation_on_password(): void
    {
        $this->request['password'] = '123';
        $this->request['password_confirmation'] = '123';

        $this->postRequest()
            ->assertInvalid(['password']);
    }

    public function test_should_fail_validation_on_unique_email(): void
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

    public function test_should_fail_validation_on_unique_username(): void
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

    public function test_redirect_to_login(): void
    {
        $response = $this->post(
            action([RegisterController::class, 'handle']),
            $this->request
        );

        $response->assertValid()
            ->assertRedirectToRoute('admin.login')
            ->assertSessionHas('helper_flash_message', __('auth.register_verify'));

        $this->followRedirects($response)->assertSee(__('auth.register_verify'));
    }

    public function test_only_guest_success(): void
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
