<?php

namespace App\Http\Requests\Auth\User;

use App\Rules\LatinLowercaseRule;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required',
                'string',
                'max:255',
                'min:3',
                new LatinLowercaseRule(),
                Rule::unique(User::class)->ignore($this->user)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user),
            ],
            'password' => [
                'nullable',
                Password::min(8)->letters()
            ],
            'slug' => [
                'nullable',
                'string',
                Rule::unique(User::class)->ignore($this->user)
            ],
            'language_id' => ['required', 'integer', 'exists:languages,id'],
            'first_name' => ['nullable','string'],
            'description' => ['nullable','string'],
            'thumbnail' => ['nullable', 'mimes:jpg,png', 'max:10024'],
            'thumbnail_selected' => ['nullable', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('auth.username'),
            'slug' => __('common.slug'),
            'first_name' => __('auth.first_name'),
            'email' => __('common.email'),
            'description' => __('common.description'),
            'thumbnail' => __('common.thumbnail'),
            'language_id' => __('common.language'),
        ];
    }
}
