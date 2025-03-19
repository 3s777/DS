<?php

namespace Support\Traits\Models;

use Illuminate\Database\Eloquent\Model;

trait HasCollector
{
    protected static function bootHasCollector(): void
    {
        static::creating(function (Model $item) {
            if (empty($item->collector_id)) {
                $item->collector_id = auth('collector')->id();
            }
        });
    }
}
