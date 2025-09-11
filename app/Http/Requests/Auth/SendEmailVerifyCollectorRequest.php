<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailVerifyCollectorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('collector')->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'exists:collectors,email'
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'email' => str(request('email'))
                ->squish()
                ->lower()
                ->value(),
        ]);
    }

    public function messages(): array
    {
        return [
            'email.exists' => __('validation.email_not_exist')
        ];
    }
}
