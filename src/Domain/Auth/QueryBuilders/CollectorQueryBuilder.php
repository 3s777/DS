<?php

namespace Domain\Auth\QueryBuilders;

use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;
use Support\Traits\QueryFiltered;
use Support\Traits\QuerySorted;

class CollectorQueryBuilder extends Builder
{
    use QueryFiltered;
    use QuerySorted;
}
