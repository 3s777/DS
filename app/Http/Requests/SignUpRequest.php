<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\LatinLowercaseRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class SignUpRequest extends FormRequest
{
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
            'name' => ['required',
                'string',
                'max:255',
                'min:3',
                new LatinLowercaseRule,
                Rule::unique(User::class)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => ['required',
                'confirmed',
                Password::min(8)->letters()
            ],
        ];
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
    }

    public function attributes(): array
    {
        return [
            'name' => __('validation.attributes.user_name')
        ];
    }
}
