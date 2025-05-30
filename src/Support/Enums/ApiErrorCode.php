<?php

namespace Support\Enums;

enum ApiErrorCode: string
{
    case  TOKEN_EXPIRED = 'token_expired';

    case TOKEN_INVALID = 'token_invalid';

    case CREDENTIALS_INVALID = 'credentials_invalid';

    case TOKEN_REFRESH_FAILED = 'token_refresh_failed';

    public function toString(): string
    {
        return match($this) {
            self::TOKEN_EXPIRED => 'Token expired',
            self::TOKEN_INVALID => 'Token invalid',
            self::CREDENTIALS_INVALID => 'Credentials invalid',
            self::TOKEN_REFRESH_FAILED => 'Token refresh failed'
        };
    }
}
