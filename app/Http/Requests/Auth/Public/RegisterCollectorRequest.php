<?php

namespace App\Http\Requests\Auth\Public;

use App\Rules\LatinLowercaseRule;
use Domain\Auth\Models\Collector;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterCollectorRequest extends FormRequest
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
            'name' => ['required',
                'string',
                'max:30',
                'min:3',
                new LatinLowercaseRule(),
                Rule::unique(Collector::class)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(Collector::class),
            ],
            'password' => ['required',
                'confirmed',
                Password::min(8)->letters()
            ],
            'language' => ['required', Rule::in(config('app.available_locales'))]
        ];
    }

    protected function prepareForValidation()
    {
        //        $this->request->add(['language_id' => $this->language->id]);

        $this->merge([
            'name' => str(request('name'))
                ->squish()
                ->lower()
                ->value(),
            'email' => str(request('email'))
                ->squish()
                ->lower()
                ->value(),
            'language' => app()->getLocale()
        ]);
    }

    public function attributes(): array
    {
        return [
            'name' => __('validation.attributes.user_name')
        ];
    }
}
