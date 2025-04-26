<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use App\Dto\AuthenticateDto;

class AuthenticateFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): AuthenticateDto
    {
        return new AuthenticateDto();
    }
}
