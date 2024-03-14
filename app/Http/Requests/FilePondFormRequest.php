<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilePondFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if($this->files->get('thumbnail') && !is_array($this->files->get('thumbnail'))) {
            return [
                'thumbnail' => ['required','image', 'mimes:png'],
            ];
        }

        return [
            'thumbnail' => ['required', 'array'],
            'thumbnail.*' => ['image', 'mimes:png']
        ];
    }
}
