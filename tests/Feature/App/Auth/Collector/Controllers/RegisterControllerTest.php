<?php

namespace App\Auth\Collector\Controllers;

use App\Http\Controllers\Auth\Collector\LoginController;
use App\Http\Controllers\Auth\Collector\RegisterController;
use App\Http\Requests\Auth\Collector\RegisterRequest;
use Database\Factories\CollectorFactory;
use Domain\Auth\Models\Role;
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

        Role::create(['name' => config('settings.default_collector_role'), 'display_name' => 'User', 'guard_name' => 'collector']);

    }

    private function postRequest(): TestResponse
    {
        return $this->post(
            action([RegisterController::class, 'handle']),
            $this->request
        );
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
            ->assertViewIs('content.auth-collector.register');
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
        CollectorFactory::new()->create([
            'email' => $this->request['email']
        ]);

        $this->assertDatabaseHas('collectors', [
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
        CollectorFactory::new()->create([
            'name' => $this->request['name']
        ]);

        $this->assertDatabaseHas('collectors', [
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
            ->assertRedirectToRoute('collector.login')
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

        $collector = CollectorFactory::new()->create([
            'password' => bcrypt($password),
        ]);

        $request = [
            'email' => $collector->email,
            'password' => $password,
        ];

        $this->post(action([LoginController::class, 'handle']), $request);

        $this->get(action([RegisterController::class, 'page']))
            ->assertRedirect('/');
    }
}
