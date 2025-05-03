<?php

namespace App\Http\Requests\Auth\Public;

use Illuminate\Foundation\Http\FormRequest;

class LoginCollectorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (auth('admin')->check()) {
            return auth('collector')->guest();
        }

        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
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
}
