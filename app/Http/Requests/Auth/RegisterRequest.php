<?php

namespace App\Http\Requests\Auth;

use App\Models\Language;
use App\Rules\LatinLowercaseRule;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Worksome\RequestFactories\Concerns\HasFactory;

class RegisterRequest extends FormRequest
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
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $locale = Language::where('slug', app()->getLocale())->first();

        $this->merge([
            'name' => str(request('name'))
                ->squish()
                ->lower()
                ->value(),
            'email' => str(request('email'))
                ->squish()
                ->lower()
                ->value(),
            'language_id' => $locale->id,
        ]);
    }

    public function attributes(): array
    {
        return [
            'name' => __('validation.attributes.user_name')
        ];
    }
}
