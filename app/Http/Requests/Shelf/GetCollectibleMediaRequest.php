<?php

namespace App\Http\Requests\Shelf;

use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Models\Shelf;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class GetCollectibleMediaRequest extends FormRequest
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
        $availableModels = array_column(CollectibleTypeEnum::cases(), 'name');

        return [
            'query' => ['nullable', 'string', 'max:250'],
            'depended' => ['required', 'array'],
            'depended.*' => [Rule::in($availableModels)]
        ];
    }
}
