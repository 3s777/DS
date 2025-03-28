<?php

namespace App\Http\Requests\Auth\Collector;

use App\Rules\LatinLowercaseRule;
use Domain\Auth\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateCollectorProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => [
                'nullable',
                Password::min(8)->letters()
            ],
            'language' => [
                'required',
                'string',
                Rule::in(config('app.available_locales'))
            ],
            'first_name' => ['nullable','string'],
            'description' => ['nullable','string'],
            'featured_image' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],
            'featured_image_selected' => ['nullable', 'bool'],
            'current_password' => [
                'required_with:new_password'
            ],
            'new_password' => [
                'nullable',
                Password::min(8)->letters()
            ],
            'new_password_confirmation' => [
                'nullable',
                'required_with:new_password',
                'confirmed:new_password',
                Password::min(8)->letters()
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('auth.username'),
            'first_name' => __('auth.first_name'),
            'email' => __('common.email'),
            'description' => __('common.description'),
            'featured_image' => __('common.featured_image'),
            'language' => __('common.language'),
            'current_password' => __('auth.current_password'),
            'new_password' => __('auth.new_password'),
            'new_password_confirmation' => __('auth.confirm_new_password')
        ];
    }
}
