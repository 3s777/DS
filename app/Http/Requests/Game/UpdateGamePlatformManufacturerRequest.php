<?php

namespace App\Http\Requests\Game;

use Domain\Game\Models\GamePlatformManufacturer;
use Domain\Game\Models\GamePublisher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGamePlatformManufacturerRequest extends FormRequest
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
            'name' => ['required', Rule::unique(GamePlatformManufacturer::class)->ignore($this->game_platform_manufacturer)],
            'slug' => ['nullable','string', Rule::unique(GamePlatformManufacturer::class)->ignore($this->game_platform_manufacturer)],
            'description' => ['nullable','string'],
            'thumbnail' => ['nullable', 'mimes:jpg,png', 'max:10024'],
            'thumbnail_selected' => ['nullable', 'string'],
            'user_id' => ['nullable', 'integer', 'exists:Domain\Auth\Models\User,id']
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
        ];
    }
}
