<?php

namespace App\Http\Requests\Auth\User;

use App\Rules\LatinLowercaseRule;
use Domain\Auth\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
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

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => str(request('name'))
                ->squish()
                ->lower()
                ->value(),
            'email' => str(request('email'))
                ->squish()
                ->lower()
                ->value(),
        ]);

        $roles = request('roles');
        $defaultRole = config('settings.default_role');

        if($roles && !in_array($defaultRole, $roles)) {
            $roles[] = $defaultRole;

            $this->merge([
                'roles' => $roles
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required',
                'string',
                'max:30',
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
            'language' => [
                'required',
                'integer',
                Rule::in(config('app.available_locales'))
            ],
            'roles' => [
                'required',
                'array',
                'exists:roles,name'
            ],
            'permissions' => [
                'nullable',
                'array',
                'exists:permissions,name'
            ],
            'first_name' => ['nullable','string'],
            'description' => ['nullable','string'],
            'thumbnail' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],
            'thumbnail_selected' => ['nullable', 'string'],
            'is_verified' => ['nullable','in:1']
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('auth.username'),
            'slug' => __('common.slug'),
            'first_name' => __('auth.first_name'),
            'email' => __('common.email'),
            'roles' => trans_choice('role.roles', 2),
            'permissions' => __('permission.permissions'),
            'description' => __('common.description'),
            'thumbnail' => __('common.thumbnail'),
            'language' => __('common.language'),
            'is_verified' => __('auth.is_verified'),
        ];
    }
}
