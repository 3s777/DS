<?php

namespace Domain\Game\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class GameDeveloperQueryBuilder extends Builder
{
    public function filtered()
    {
        return app(Pipeline::class)
            ->send($this)
            ->through(filters())
            ->thenReturn();
    }

    public function sorted()
    {
        return sorter([
            'id',
            'name',
            'created_at'
        ])->run($this);
    }
}
