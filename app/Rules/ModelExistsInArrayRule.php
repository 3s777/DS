<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ModelExistsInArrayRule implements ValidationRule
{
    public function __construct(public string $modelName, public string $modelKey)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($value as $key) {
            if (!$this->modelName::where($this->modelKey, $key)->exists()) {
                $fail('validation.array_model_not_exist')->translate();
            }
        }
    }
}
