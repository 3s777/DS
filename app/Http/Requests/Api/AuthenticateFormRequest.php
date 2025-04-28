<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use App\Dto\AuthenticateDto;

class AuthenticateFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guest();
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => __('validation.attributes.user_name')
        ];
    }

    public function toDto(): AuthenticateDto
    {
        return new AuthenticateDto(
            $this->input('email'),
            $this->input('password')
        );
    }
}
