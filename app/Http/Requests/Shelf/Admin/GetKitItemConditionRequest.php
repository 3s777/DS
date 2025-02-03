<?php

namespace App\Http\Requests\Shelf\Admin;

use Domain\Shelf\Enums\CollectibleTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetKitItemConditionRequest extends FormRequest
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
            'model' => ['required', Rule::in($availableModels)],
            'media' => ['required', 'integer']
        ];
    }
}
