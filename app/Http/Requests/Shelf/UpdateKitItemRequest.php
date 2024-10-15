<?php

namespace App\Http\Requests\Shelf;

use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKitItemRequest extends FormRequest
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
                'max:250'
            ],
            'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique(KitItem::class)->ignore($this->kit_item)
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('common.name'),
            'slug' => __('common.slug'),
        ];
    }
}
