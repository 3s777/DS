<?php

namespace Domain\Shelf\Contracts;

interface Collectable
{
    public function getMediableId(): int;

    public function getMediableType(): string;
}
