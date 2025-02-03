<?php

namespace App\Http\Requests\Game\Admin;

use Domain\Game\Enums\GamePlatformTypeEnum;
use Domain\Game\Models\GamePlatform;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateGamePlatformRequest extends FormRequest
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
                Rule::unique(GamePlatform::class)
            ],
            'type' => [
                'required',
                Rule::enum(GamePlatformTypeEnum::class)
            ],
            'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique(GamePlatform::class)
            ],
            'description' => ['nullable','string'],
            'featured_image' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],
            'user_id' => [
                'nullable',
                'integer',
                'exists:Domain\Auth\Models\User,id'
            ],
            'game_platform_manufacturer_id' => [
                'nullable',
                'integer',
                'exists:Domain\Game\Models\GamePlatformManufacturer,id'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans_choice('common.name', 1),
            'slug' => __('common.slug'),
            'description' => __('common.description'),
            'featured_image' => __('common.featured_image'),
            'user_id' => trans_choice('user.users', 1),
            'type' => __('game_platform.type'),
            'game_platform_manufacturer_id' => __('game_platform_manufacturer.manufacturer')
        ];
    }
}
