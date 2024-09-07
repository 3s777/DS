<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MassDeletingRequest extends FormRequest
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
            'ids' => 'regex:/^[0-9,]+$/u',
        ];
    }

    public function messages()
    {
        return [
            'ids' => __('common.unable_mass_deleting')
        ];
    }
}
