<?php

namespace Support\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasSelectedCollector
{
    protected function getSelectedCollector(?Model $model): array
    {
        $selectedCollector = [];
        if ($model?->collector) {
            $selectedCollector = [
                'key' => $model->collector->id,
                'value' => $model->collector->name,
            ];
        }

        return $selectedCollector;
    }
}
