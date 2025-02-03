<?php

namespace Domain\Auth\QueryBuilders;

use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class CollectorQueryBuilder extends Builder
{
    protected $model = User::class;

    public function filtered()
    {
        if(request('filters')) {
            return app(Pipeline::class)
                ->send($this)
                ->through(filters($this->model->availableFilters()))
                ->thenReturn();
        }

        // Add filters for rendering filter->view()
        filters($this->model->availableFilters());
        return $this;
    }

    public function sorted(string $defaultField = 'id', string $defaultOrder = 'desc'): \Illuminate\Contracts\Database\Eloquent\Builder
    {
        return sorter($this->model->sortedFields, $defaultField, $defaultOrder)->run($this);
    }
}
