<?php

namespace App\Http\Requests\Auth\Public;

use Domain\Auth\Models\Collector;
use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailCollectorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $collector = Collector::find($this->route('id'));

        if (!$collector) {
            return false;
        }

        if (! hash_equals(sha1($collector->getEmailForVerification()), (string) $this->route('hash'))) {
            return false;
        }

        return true;
    }
}
