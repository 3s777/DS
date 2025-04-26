<?php

declare(strict_types=1);

namespace App\Contracts\Api;

/**
* @template T
* @template D
**/
interface ResponseResolverContract
{
    /**
    * @param D $data
    **/
    public function with(mixed $data): static;

    /**
    * @return T
    **/
    public function resolve(): mixed;
}
