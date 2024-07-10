<?php

namespace App\Http\Requests\Game;

use App\Enums\GamePlatformTypeEnum;
use Domain\Game\Models\GamePlatform;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGamePlatformRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    //    public function prepareForValidation()
    //    {
    //        $this->merge([
    //            'slug' => Str::slug($this->slug)
    //        ]);
    //    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique(GamePlatform::class)->ignore($this->game_platform)],
            'type' => ['required', Rule::enum(GamePlatformTypeEnum::class)],
            'slug' => ['nullable','string', Rule::unique(GamePlatform::class)->ignore($this->game_platform)],
            'description' => ['nullable','string'],
            'thumbnail' => ['nullable', 'mimes:jpg,png', 'max:10024'],
            'thumbnail_selected' => ['nullable', 'string'],
            'user_id' => ['nullable', 'integer', 'exists:Domain\Auth\Models\User,id'],
            'game_platform_manufacturer_id' => ['nullable', 'integer', 'exists:Domain\Game\Models\GamePlatformManufacturer,id'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('common.name'),
            'slug' => __('common.slug'),
            'description' => __('common.description'),
            'thumbnail' => __('common.thumbnail'),
            'user_id' => __('common.user'),
            'type' => __('game_platform_manufacturer.manufacturer'),
            'game_platform_manufacturer_id' => __('game_platform_manufacturer.manufacturer')
        ];
    }
}
