<?php

namespace Support\Traits\Models;

trait HasImages
{
    public function getImagesCollection(): string
    {
        return 'thumbnail';
    }
}
