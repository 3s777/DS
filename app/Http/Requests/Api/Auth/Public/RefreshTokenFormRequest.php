<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Auth\Public;

use Illuminate\Foundation\Http\FormRequest;

class RefreshTokenFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'refresh_token' => ['required', 'string'],
        ];
    }
}
