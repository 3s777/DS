<?php

namespace Domain\Game\QueryBuilders;

use Domain\Game\Models\GamePublisher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class GamePublisherQueryBuilder extends Builder
{
    protected $model = GamePublisher::class;

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
