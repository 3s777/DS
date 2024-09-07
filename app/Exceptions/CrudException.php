<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CrudException extends Exception
{
    public function render(Request $request)
    {
    }
}
