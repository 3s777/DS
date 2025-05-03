<?php

namespace App\Http\Requests\Auth\Admin;

use Domain\Auth\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
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
                Rule::unique(Permission::class)->ignore($this->permission)
            ],
            'display_name' => ['required','string'],
            'guard_name' => [
                'required',
                'in:admin,collector'
            ],
            'description' => ['nullable','string'],
            'permissions' => ['nullable', 'array']
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => trans_choice('common.name', 1),
            'display_name' => __('common.display_name'),
            'description' => __('common.description'),
            'permissions' => __('user.permission.permissions'),
            'guard_name' => __('user.type')
        ];
    }
}
