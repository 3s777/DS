<?php

declare(strict_types=1);

namespace App\Contracts\Api;

use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
* @template-covariant T of ResponseResolverContract
**/
interface ResponderContract
{
    /**
    * @param T $resolver
    **/
    public function respond(ResponseResolverContract $resolver): Response;

    public function error(Throwable $e): Response;
}
