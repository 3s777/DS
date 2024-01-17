<?php

namespace App\Http\Requests\Game;

use Domain\Game\Models\Developer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateDeveloperRequest extends FormRequest
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
            'name' => ['required', Rule::unique(Developer::class)],
            'slug' => ['nullable', 'string', Rule::unique(Developer::class)],
            'description' => ['string']
        ];
    }
}
