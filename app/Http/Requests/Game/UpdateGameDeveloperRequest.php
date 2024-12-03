<?php

namespace App\Http\Requests\Game;

use Domain\Game\Models\GameDeveloper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateGameDeveloperRequest extends FormRequest
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
            'name' => [
                'required',
                'max:250',
                Rule::unique(GameDeveloper::class)->ignore($this->game_developer)
            ],
            'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique(GameDeveloper::class)->ignore($this->game_developer)
            ],
            'description' => ['nullable','string'],
            'thumbnail' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],
            'thumbnail_selected' => ['nullable', 'string'],
            'user_id' => [
                'nullable',
                'integer',
                'exists:Domain\Auth\Models\User,id',
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans_choice('common.name', 1),
            'slug' => __('common.slug'),
            'description' => __('common.description'),
            'thumbnail' => __('common.thumbnail'),
            'user_id' => trans_choice('user.users', 1),
        ];
    }
}
