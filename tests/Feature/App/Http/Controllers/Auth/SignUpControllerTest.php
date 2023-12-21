<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\SignUpController;
use App\Http\Requests\SignUpRequest;
use App\Notifications\VerifyEmailNotification;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class SignUpControllerTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = SignUpRequest::factory()->create([
            'email' => 'qqq@qqq.qq',
            'name' => 'qqqqq',
            'password' => '123456789q',
            'password_confirmation' => '123456789q'
        ]);
    }

    private function request(): TestResponse
    {
        return $this->post(
            action([SignUpController::class, 'handle']),
            $this->request
        );
    }

    private function findUser(): User
    {
        return User::query()
            ->where('email', $this->request['email'])
            ->first();
    }

    /**
     * @test
     * @return void
     */
    public function it_page_success(): void
    {
        $this->get(action([SignUpController::class, 'page']))
            ->assertOk()
            ->assertSee('Регистрация')
            ->assertViewIs('content.auth.register');
    }

    /**
     * @test
     * @return void
     */
    public function it_validation_success(): void
    {
        $this->request()
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

        $this->request()
            ->assertInvalid(['password']);
    }

    /**
     * @test
     * @return void
     */
    public function it_user_created_success(): void
    {
        $this->assertDatabaseMissing('users', [
            'email' => $this->request['email']
        ]);

        $this->request();

        $this->assertDatabaseHas('users', [
            'email' => $this->request['email']
        ]);
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

        $this->request()
            ->assertInvalid(['email']);
    }

    /**
     * @test
     * @return void
     */
    public function it_registered_event_and_listeners_dispatched(): void
    {
        Event::fake();

        $this->request();

        Event::assertDispatched(Registered::class);
        Event::assertListening(
            Registered::class,
            SendEmailVerificationNotification::class
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_notification_sent(): void
    {
        $this->request();

//        Notification::assertCount(3);

        $user = User::query()
            ->where('email', $this->request['email'])
            ->first();

        Notification::assertSentTo(
            $this->findUser(),
            VerifyEmailNotification::class
        );
    }

}
