<?php

namespace App\Auth\DTOs;

use App\Http\Requests\Auth\LoginRequest;
use Domain\Auth\DTOs\LoginUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginUserDTOTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_form_request_success(): void
    {
        $request = [
            'email' => 'test@dustyshelf.test',
            'password' => 'password'
        ];

        $data = LoginUserDTO::fromRequest(new LoginRequest($request));

        $this->assertInstanceOf(LoginUserDTO::class, $data);
    }


    /**
     * @test
     * @return void
     */
    public function it_instance_created_success(): void
    {
        $data = LoginUserDTO::make(
            'test@dustyshelf.test',
            'password',
            true
        );

        $this->assertInstanceOf(LoginUserDTO::class, $data);
    }
}
