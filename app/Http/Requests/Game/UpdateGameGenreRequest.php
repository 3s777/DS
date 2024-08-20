<?php

namespace App\Http\Requests\Game;

use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePublisher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGameGenreRequest extends FormRequest
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
                Rule::unique(GameGenre::class)->ignore($this->game_genre)
            ],
            'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique(GameGenre::class)->ignore($this->game_genre)
            ],
            'description' => ['nullable','string'],
            'user_id' => [
                'nullable',
                'integer',
                'exists:Domain\Auth\Models\User,id'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('common.name'),
            'slug' => __('common.slug'),
            'description' => __('common.description'),
            'user_id' => trans_choice('user.users', 1),
        ];
    }
}
