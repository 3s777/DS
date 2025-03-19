<?php

namespace Support\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransactionException extends Exception
{
    public function render(Request $request): ?RedirectResponse
    {
        if (app()->isProduction()) {
            flash()->danger(__('errors.try_later'));

            return session()->previousUrl()
                ? back()
                : redirect()->route('home');
        }

        return null;
    }
}
