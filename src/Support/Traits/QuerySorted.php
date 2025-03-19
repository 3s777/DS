<?php

namespace Support\Traits;

trait QuerySorted
{
    public function sorted(string $defaultField = 'id', string $defaultOrder = 'desc'): \Illuminate\Contracts\Database\Eloquent\Builder
    {
        return sorter($this->model->sortedFields, $defaultField, $defaultOrder)->run($this);
    }
}
