<?php

declare(strict_types=1);

namespace Domain\Auth\DTOs\Api;

use SensitiveParameter;

final readonly class AuthenticateDto
{
    public function __construct(
        private string $email,
        #[SensitiveParameter]
        private string $password
    ) {
        //
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email
        ];
    }
}
