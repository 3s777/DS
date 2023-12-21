<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Notifications\VerifyEmailNotification;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_login_page_success(): void
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
    public function it_register_page_success(): void
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
    public function it_forgot_page_success(): void
    {
        $this->get(action([ForgotPasswordController::class, 'page']))
            ->assertOk()
            ->assertSee('Забыли')
            ->assertViewIs('content.auth.forgot-password');
    }

    /**
     * @test
     * @return void
     */
    public function it_sign_in_page_success(): void
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
    public function it_logout_success(): void
    {
        $user = UserFactory::new()->create([]);

        $this->actingAs($user)->delete(action([SignInController::class, 'logout']));

        $this->assertGuest();
    }

    /**
     * @test
     * @return void
     */
    public function it_sign_up_success(): void
    {
        Notification::fake();
        Event::fake();

        $this->app->setLocale('ru');

        $request = SignUpRequest::factory()->create([
            'password' => '123456789q',
            'password_confirmation' => '123456789q'
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => $request['email']
        ]);

        $response = $this->post(
            action([SignUpController::class, 'handle']),
            $request
        );

        $response->assertValid();

        $this->assertDatabaseHas('users', [
            'email' => $request['email']
        ]);

        $user = User::query()
            ->where('email', $request['email'])
            ->first();

        Event::assertDispatched(Registered::class);
        Event::assertListening(Registered::class, SendEmailVerificationNotification::class);

        $event = new Registered($user);

        $listener = new SendEmailVerificationNotification();
        $listener->handle($event);

        Notification::assertSentTo($user, VerifyEmail::class);


        $response->assertRedirect(route('login'));
    }
}
