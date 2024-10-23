<?php

namespace App\Http\Requests\Shelf;

use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Models\Shelf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCollectibleGameRequest extends FormRequest
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
                'max:250',
                Rule::unique(Shelf::class)
            ],
            'user_shelf' => [
                'required',
                'integer',
                'exists:Domain\Auth\Models\User,id'
            ],
            'shelf_id' => [
                'required',
                'integer',
                'exists:Domain\Shelf\Models\Shelf,id'
            ],
            'number' => [
                'nullable',
                'string',
                'max:250',
            ],
            'condition' => [
                'required',
                Rule::enum(ConditionEnum::class)
            ],
            'purchase_price' => [
                'nullable',
                'numeric',
                'max: 100000000'
            ],
            'seller' => [
                'nullable',
                'string',
                'max:250'
            ],
            'purchase_date' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'additional_field' => [
                'nullable',
                'string',
                'max:250'
            ],
            'is_done' => [
                'boolean'
            ],
            'is_digital' => [
                'boolean'
            ],
            'media' => [
                'required',
                'integer',
                'exists:Domain\Game\Models\GameMedia,id'
            ],
            'target' => [
              'required',
              'string'
            ],
            'sale_price' => [
                'exclude_unless:target,sale',
                'required',
                'numeric'
            ],
            'auction_price' => [
                'exclude_unless:target,auction',
                'required',
                'numeric'
            ],
            'auction_step' => [
                'exclude_unless:target,auction',
                'required',
                'numeric'
            ],
            'auction_date_stop' => [
                'exclude_unless:target,auction',
                'date',
                'date_format:Y-m-d'
            ],
            'conditions' => [
                'required'
            ],
//            'conditions.*' => [
//                'sometimes',
//                'numeric'
//            ],
            'description' => ['nullable','string'],
            'thumbnail' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],

        ];
    }

    public function attributes()
    {
        return [
            'name' => __('common.name'),
            'number' => trans_choice('common.number', 1),
            'description' => __('common.description'),
            'thumbnail' => __('common.thumbnail'),
            'user_id' => trans_choice('user.users', 1),
        ];
    }
}
