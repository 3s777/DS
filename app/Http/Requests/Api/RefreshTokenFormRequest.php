<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use App\Dto\AuthenticateDto;

class RefreshTokenFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'refresh_token' => ['required', 'string'],
        ];
    }
}
