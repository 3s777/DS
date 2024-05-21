<?php

namespace App\Http\Requests\Auth\User;

use Domain\Auth\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique(User::class)],
            'email' => ['required','email', Rule::unique(User::class)],
            'password' => ['required'],
            'language_id' => ['required', 'integer', 'exists:App\Models\Language,id'],
            'slug' => ['nullable','string', Rule::unique(User::class)],
            'description' => ['nullable','string'],
            'thumbnail' => ['nullable', 'mimes:jpg,png', 'max:10024'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('common.name'),
            'slug' => __('common.slug'),
            'email' => __('common.email'),
            'description' => __('common.description'),
            'thumbnail' => __('common.thumbnail'),
            'language_id' => __('common.user'),
        ];
    }
}
