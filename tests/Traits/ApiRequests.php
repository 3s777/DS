<?php

namespace Tests\Traits;

use Domain\Auth\Models\User;
use Illuminate\Testing\TestResponse;

trait ApiRequests
{
    protected function tokenRequest(bool $invalid = false): TestResponse
    {
        $user = User::factory()->create([
            'email' => 'test@test.test',
            'password' => bcrypt('secret')
        ]);

        return $this->postJson(route('api.authenticate'), [
            'email' => $user->email,
            'password' => $invalid ? 'password' : 'secret',
        ]);
    }
}
