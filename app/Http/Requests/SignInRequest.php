<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Worksome\RequestFactories\Concerns\HasFactory;

class SignInRequest extends FormRequest
{
    use HasFactory;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'username' => ['required'],
            'password' => ['required']
        ];
    }

    public function attributes(): array
    {
        return [
            'username' => __('validation.attributes.user_name')
        ];
    }
}
