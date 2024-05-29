<?php

namespace App\Http\Requests\Auth\Role;

use App\Rules\LatinLowercaseRule;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

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
            'description' => ['nullable','string']
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('common.name'),
            'first_name' => __('common.display_name'),
            'description' => __('common.description'),
        ];
    }
}
