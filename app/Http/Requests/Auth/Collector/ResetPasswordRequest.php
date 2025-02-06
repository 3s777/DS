<?php

namespace App\Http\Requests\Auth\Collector;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('collector')->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => [
                'required',
                'string',
                'email',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()
            ],
        ];
    }
}
