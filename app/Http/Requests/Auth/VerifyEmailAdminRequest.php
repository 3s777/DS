<?php

namespace App\Http\Requests\Auth;

use Domain\Auth\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = User::find($this->route('id'));

        if (!$user) {
            return false;
        }

        if (! hash_equals(sha1($user->getEmailForVerification()), (string) $this->route('hash'))) {
            return false;
        }

        return true;
    }
}
