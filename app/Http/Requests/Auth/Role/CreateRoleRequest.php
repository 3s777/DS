<?php

namespace App\Http\Requests\Auth\Role;

use App\Rules\ModelExistsInArrayRule;
use Domain\Auth\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRoleRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3',
                Rule::unique(Role::class)
            ],
            'display_name' => ['required','string'],
            'description' => ['nullable','string'],
            'permissions' => [
                'nullable',
                'array',
                'exists:permissions,name'
//                new ModelExistsInArrayRule('Domain\Auth\Models\Permission', 'name'),
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => trans_choice('common.name', 1),
            'display_name' => __('common.display_name'),
            'description' => __('common.description'),
            'permissions' => __('user.permission.permissions'),
        ];
    }

}
