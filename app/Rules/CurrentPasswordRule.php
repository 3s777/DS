<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class CurrentPasswordRule implements ValidationRule
{
    public function __construct(public Model|Authenticatable $user)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value) {
            if (!Hash::check($value, $this->user->password)) {
                $fail('auth.error.credentials')->translate();
            }
        }
    }
}
