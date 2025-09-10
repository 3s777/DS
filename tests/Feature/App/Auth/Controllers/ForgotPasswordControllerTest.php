<?php

namespace App\Auth\Controllers;

use App\Http\Controllers\Auth\Public\Admin\ForgotPasswordController;
use Database\Factories\Auth\UserFactory;
use Domain\Auth\Notifications\ResetPasswordAdminNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    private function testingCredentials(): array
    {
        return [
            'email' => 'qqq@qq.qq',
        ];
    }

    public function test_page_success(): void
    {
        $this->get(action([ForgotPasswordController::class, 'page']))
            ->assertOk()
            ->assertViewIs('content.auth.forgot-password');
    }

    public function test_handle_success(): void
    {
        $user = UserFactory::new()->create($this->testingCredentials());

        $this->post(action([ForgotPasswordController::class, 'handle']), $this->testingCredentials())
            ->assertRedirectToRoute('admin.forgot');

        Notification::assertSentTo([$user], ResetPasswordAdminNotification::class);
    }

    public function test_handle_fail(): void
    {
        $this->assertDatabaseMissing('users', $this->testingCredentials());

        $this->post(action([ForgotPasswordController::class, 'handle']), $this->testingCredentials())
            ->assertRedirectToRoute('admin.forgot');

        Notification::assertNothingSent();
    }
}
