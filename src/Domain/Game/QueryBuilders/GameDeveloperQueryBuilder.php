<?php

namespace Domain\Game\QueryBuilders;

use Domain\Game\Models\GameDeveloper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Client\Request;
use Illuminate\Pipeline\Pipeline;

class GameDeveloperQueryBuilder extends Builder
{
    protected $model = GameDeveloper::class;

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

    public function sorted(string $defaultField = 'id', string $defaultOrder = 'desc')
    {
//        if(request('sort')) {
            return sorter($this->model->sortedFields, $defaultField, $defaultOrder)->run($this);
//        }
//
//        return $this;
    }
}
