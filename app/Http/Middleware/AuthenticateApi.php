<?php

namespace App\Http\Middleware;

use Domain\Auth\JWT;
use Illuminate\Http\Request;

class AuthenticateApi extends \Illuminate\Auth\Middleware\Authenticate
{
    // authenticate and check token without guard with middleware
//    protected function authenticate($request, array $guards)
//    {
//        $token = $request->bearerToken();
//
//        $jwt = app(JWT::class);
//
//        try {
//            $id = $jwt->parse($token);
//
//            auth()->loginUsingId($id);
//        } catch () {
//
//        }
//    }
}
