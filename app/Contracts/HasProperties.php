<?php

namespace App\Contracts;

interface HasProperties
{
    public static function getProperties($values): ?array;

    public static function setProperties($values): ?array;
}
