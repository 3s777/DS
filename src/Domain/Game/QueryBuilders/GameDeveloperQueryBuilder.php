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

        filters($this->model->availableFilters());
        return $this;
    }

    public function sorted()
    {
        if(request('sort')) {
            return sorter($this->model->sortedFields)->run($this);
        }

        return $this;
    }
}
