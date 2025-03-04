<?php

namespace App\Http\Requests\Game\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FilterGameRequest extends FormRequest
{
    protected $redirectRoute = 'admin.games.index';

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
            'filters.search' => [
                'nullable',
                'string',
                'max:250'
            ],
            'filters.dates.from' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'filters.dates.to' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'filters.released_at.from' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'filters.released_at.to' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'filters.genres' => ['nullable', 'array'],
            'filters.platforms' => ['nullable', 'array'],
            'filters.developers' => ['nullable', 'array'],
            'filters.publishers' => ['nullable', 'array'],
            'filters.user' => [
                'nullable',
                'integer',
                'exists:Domain\Auth\Models\User,id'
            ],
        ];
    }

    public function messages()
    {
        return [
            'filters.dates.from' => __('validation.filters_date'),
            'filters.dates.to' => __('validation.filters_date'),
        ];
    }

    public function attributes()
    {
        return [
            'filters.search' => __('common.search'),
            'filters.dates' => __('common.dates'),
            'filters.user' => trans_choice('user.users', 1),
            'filters.genres' => trans_choice('game.genre.genres', 2),
            'filters.platforms' => trans_choice('game.platform.platforms', 2),
            'filters.developers' => trans_choice('game.developer.developers', 2),
            'filters.publishers' => trans_choice('game.publisher.publishers', 2),
            'filters.released_at.from' => __('game.released_at_from'),
            'filters.released_at.to' => __('game.released_at_to'),
        ];
    }
}
