<?php

namespace Domain\Game\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Support\Traits\QueryFiltered;
use Support\Traits\QuerySorted;

class GameDeveloperQueryBuilder extends Builder
{
    use QueryFiltered;
    use QuerySorted;

    //    protected $model = GameDeveloper::class;
}
