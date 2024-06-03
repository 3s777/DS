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

    protected function prepareForValidation()
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
            'roles' => ['required', 'array', 'exists:roles,name'],
            'first_name' => ['nullable','string'],
            'description' => ['nullable','string'],
            'thumbnail' => ['nullable', 'mimes:jpg,png', 'max:10024'],
            'thumbnail_selected' => ['nullable', 'string'],
            'is_verified' => ['nullable','in:1']
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('auth.username'),
            'slug' => __('common.slug'),
            'first_name' => __('auth.first_name'),
            'email' => __('common.email'),
            'roles' => __('role.roles'),
            'description' => __('common.description'),
            'thumbnail' => __('common.thumbnail'),
            'language_id' => __('common.language'),
            'is_verified' => __('auth.is_verified'),
        ];
    }
}
