<?php

namespace Domain\Auth\Exceptions;

use Exception;
use Illuminate\Http\Request;

class UserCreateEditException extends Exception
{
    public function render(Request $request)
    {
    }
}
