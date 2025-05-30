<?php

namespace Domain\Auth\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserCreateEditException extends Exception
{
    public function render(): ?RedirectResponse
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
