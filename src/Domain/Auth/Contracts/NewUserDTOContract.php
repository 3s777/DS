<?php

namespace Domain\Auth\Contracts;

use Illuminate\Http\Request;

interface NewUserDTOContract
{
    public static function fromRequest(Request $request);
}
