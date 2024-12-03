<?php

namespace Support\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MassDeletingException extends Exception
{
    public function render(Request $request): RedirectResponse
    {
        flash()->danger(__('common.unable_mass_deleting'));

        return session()->previousUrl()
            ? back()
            : redirect()->route('home');
    }
}
