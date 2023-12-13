<?php

namespace Supports\Flash;

class FlashMessage
{
    public function __construct(protected string $message, protected string $type, protected string $icon)
    {
    }

    public function message(): string
    {
        return $this->message;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function icon(): string
    {
        return $this->icon;
    }
}
